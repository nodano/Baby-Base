<?php

namespace Http\Controllers;

use Database\DBAccess;
use Http\Controllers\Controller;

class TransactionController extends Controller
{
  /**
   * GET transactions/[:id]
   *
   * @param integer $id - transactions_id
   * @return void
   */
  public function fetchByID(int $id)
  {
    // ログイン確認
    if (!$this->auth->check()) {
      $this->push("auth/login");
    }

    $dba = DBAccess::getInstance();

    // 別々の変数で利用する方が利便性が高いため、テーブル結合は行わない
    // データベースから取引情報を取得
    $stmt = $dba->query("SELECT id, product_id, user_id, purchase_date, status FROM transactions WHERE id = ? LIMIT 1;", [$id]);
    $transactions = $stmt->fetch();
    if (!$transactions) {
      $this->push("");
    }

    // データベースから商品の情報を取得
    $stmt = $dba->query("SELECT id, name, price, user_id FROM products WHERE id = ? LIMIT 1;", [$transactions['product_id']]);
    $product = $stmt->fetch();

    $user = $this->auth->getUser();
    $user_id = $user->getId();
    $is_seller = $product['user_id'] === $user_id;
    // 出品者ではない 又は 購入者ではない
    if ($is_seller == false && $transactions['user_id'] !== $user_id) {
      $this->push("");
    }

    $params = ['product' => $product, 'transactions' => $transactions, 'is_seller' => $is_seller];
    /**
     * status
     *  0 = 初期状態 - index.php
     *  1 = 支払い済み & 発送前 - paid.php
     *  2 = 配送中 - delivery.php
     *  3 = 受け取り済み & 購入者受け取り完了前 - receivedd$id. {}php
     *  4 = 取引完了 - completed.php
     */
    $status = $transactions['status'];
    switch ($status) {
      case 0:
        if (!$is_seller) {
          $stmt = $dba->query("SELECT * FROM addresses WHERE user_id = ? LIMIT 1;", [$user_id]);
          $params['address'] = $stmt->fetch();
        }
        $this->view("transactions/index.php", $params);
        break;
      case 1:
        $this->view("transactions/paid.php", $params);
        break;
      case 2:
        $this->delivery($id);
        break;
      case 3:
        $this->view("transactions/received.php", $params);
        break;
      case 4:
        $this->view("transactions/completed.php", $params);
        break;
    }
  }

  /**
   * POST transactions/[:id]
   * 
   * @param integer $id - product_id
   */
  public function transaction(int $id)
  {
    // ログイン確認
    if (!$this->auth->check()) {
      $this->push("auth/login");
    }

    $user = $this->auth->getUser();
    $user_id = $user->getId();

    $dba = DBAccess::getInstance();

    $stmt = $dba->query("SELECT user_id, status FROM products WHERE id = ? LIMIT 1;", [$id]);
    $product = $stmt->fetch();
    // 自演購入&取引済みではない
    if ($product['user_id'] === $user_id || $product['status'] === 1) {
      $this->push("products/${id}");
    }

    // productsを取引中(1)に変える
    $dba->query("UPDATE products SET status = 1 WHERE id = ? LIMIT 1;", [$id]);

    // 新規取引を登録する
    $dba->query("INSERT INTO transactions (product_id, user_id) VALUES (?, ?);", [$id, $user_id]);
    $transactions_id = $dba->getLastInsertID();

    // 新規取引のidに遷移
    $this->push("transactions/${transactions_id}");
  }

  /**
   * POST transactions/[:id]/payments
   */
  public function payments($id)
  {
    // ログイン確認
    if (!$this->auth->check()) {
      $this->push("auth/login");
    }

    $dba = DBAccess::getInstance();

    $user = $this->auth->getUser();
    $user_id = $user->getId();

    $stmt = $dba->query("SELECT user_id FROM transactions WHERE id = ? LIMIT 1;", [$id]);
    $transactions = $stmt->fetch();
    // 取得失敗 又は 購入者ではない
    if ($transactions === false || $transactions['user_id'] !== $user_id) {
      $this->push("products/${id}");
    }

    /**
     * アドレステーブルにUPSERT
     */
    $building = $_POST['building'] | "";
    $room_number = $_POST['room_number'] | "";
    $params = [$user_id, $_POST['postcode'], $_POST['prefecture'], $_POST['city'], $_POST['chomei'], $building, $room_number, $_POST['postcode'], $_POST['prefecture'], $_POST['city'], $_POST['chomei'], $building, $room_number];
    $dba->query("INSERT INTO addresses (user_id, postcode, prefecture, city, chomei, building, room_number) VALUES (?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE postcode = ?, prefecture = ?, city = ?, chomei = ?, building = ?, room_number = ?;", $params);

    // paymentsテーブルにinsert
    $params = [$id, intval($_POST['method']), 0];
    $dba->query("INSERT INTO payments (transaction_id, method, status, completion_date) VALUES (?, ?, ?, now());", $params);

    // transactionsテーブルの状態を1(支払い済みに)
    $dba->query("UPDATE transactions SET status = 1 WHERE id = ? LIMIT 1;", [$id]);

    // 取引画面に戻る
    $this->push("transactions/${id}");
  }

  /**
   * POST transactions/[:id]/send
   */
  public function send($id)
  {
    // ログイン確認
    if (!$this->auth->check()) {
      $this->push("auth/login");
    }

    $dba = DBAccess::getInstance();

    $user = $this->auth->getUser();
    $user_id = $user->getId();
    $stmt = $dba->query("SELECT products.user_id FROM transactions INNER JOIN products ON transactions.product_id = products.id WHERE transactions.id = ? LIMIT 1", [$id]);
    $result = $stmt->fetch();
    // 出品者ではない
    if ($result['user_id'] !== $user_id) {
      $this->push("");
    }

    // transactionsテーブルの状態を2(配送中)に
    $dba->query("UPDATE transactions SET status = 2 WHERE id = ? LIMIT 1;", [$id]);

    // deliveriesテーブルに配送開始時間を保存
    $dba->query("INSERT INTO deliveries (transaction_id) VALUES (?);", [$id]);

    // 取引画面に戻る
    $this->push("transactions/${id}");
  }

  /**
   * GET transactions/[:id] & transactions.status = 2
   * 配送状態の管理
   */
  private function delivery($id)
  {
    // 配送開始時間を取得
    $dba = DBAccess::getInstance();
    $stmt = $dba->query("SELECT start FROM deliveries WHERE transaction_id = ?;", [$id]);
    $delivery = $stmt->fetch();

    // 時間の差から現在の状態を計算する
    date_default_timezone_set('Asia/Tokyo');
    $start_timestamp = strtotime($delivery['start']);
    $current_timestamp = strtotime(date('Y-m-d H:i:s'));

    $time_diff = floor(($current_timestamp - $start_timestamp) / 60); // 何分経過したのか

    if ($time_diff >= 2) {
      // 配送作業は行わないため、2分経過で配達完了
      // 状態を3(配送済み)に
      $dba->query("UPDATE transactions SET status = 3 WHERE id = ? LIMIT 1;", [$id]);

      // 取引画面に遷移
      $this->push("transactions/${id}");
    } else {

      // headerに必要な情報を入手
      $stmt = $dba->query("SELECT id, product_id, user_id, purchase_date, status FROM transactions WHERE id = ? LIMIT 1;", [$id]);
      $transactions = $stmt->fetch();

      $stmt = $dba->query("SELECT id, name, price, user_id FROM products WHERE id = ? LIMIT 1;", [$transactions['product_id']]);
      $product = $stmt->fetch();

      $this->view("transactions/delivery.php", ['product' => $product, 'transactions' => $transactions, 'status' => $time_diff]);
    }
  }

  /**
   * POST transactions/[:id]/received
   */
  public function received($id)
  {
    // ログイン確認
    if (!$this->auth->check()) {
      $this->push("auth/login");
    }

    $dba = DBAccess::getInstance();

    $user = $this->auth->getUser();
    $user_id = $user->getId();

    $stmt = $dba->query("SELECT transactions.user_id, products.price FROM transactions LEFT OUTER JOIN products ON transactions.product_id = products.id WHERE transactions.id = ? LIMIT 1;", [$id]);
    $transactions = $stmt->fetch();

    // 取得失敗 又は 購入者ではない
    if ($transactions === false || $transactions['user_id'] !== $user_id) {
      $this->push("products/${id}");
    }

    // transactionの状態を4に、完了日を更新
    $dba->query("UPDATE transactions SET status = 4 WHERE id = ? LIMIT 1;", [$id]);

    // transfersテーブルに利益を保存
    $profit = $transactions['price'] * 0.9;
    $dba->query("INSERT INTO transfers (transaction_id, amount) VALUES (?, ?);", [$id, $profit]);

    // 取引画面に戻る
    $this->push("transactions/${id}");
  }
}
