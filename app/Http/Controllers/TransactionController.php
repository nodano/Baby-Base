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
    // idの正当性

    // ログイン確認
    if (!$this->auth->check()) {
      $this->push("auth/login");
    }

    $dba = DBAccess::getInstance();

    // データベースから取引情報を取得
    $stmt = $dba->query("SELECT id, product_id, user_id, purchase_date, status FROM transactions WHERE id = ? LIMIT 1;", [$id]);
    $transactions = $stmt->fetch();

    // 取得できたか

    // データベースから商品の情報を取得
    $stmt = $dba->query("SELECT id, name, price, user_id FROM products WHERE id = ? LIMIT 1;", [$transactions['product_id']]);
    $product = $stmt->fetch();

    echo "<pre>";
    var_dump($transactions);
    var_dump($product);
    echo "</pre>";

    /**
     * 本人確認
     * 
     * 出品物or購入者か
     * 出品者or購入者とログインしている人が同一か?
     */
    $user = $this->auth->getUser();
    $user_id = $user->getId();

    $is_seller = $product['user_id'] === $user_id;

    $params = ['product' => $product, 'transactions' => $transactions, 'is_seller' => $is_seller];
    /**
     * status
     *  0 = 初期状態 - index.php
     *  1 = 支払い済み & 発送前 - paid.php
     *  2 = 配送中 - delivery.php
     *  3 = 受け取り済み & 購入者受け取り完了前 - receivedd$id. {}php
     *  4 = 取引完了 - completed.php
     * 
     * 出品者
     *  0: 支払いが済んでいないことを表示
     *  1: 支払い済み & 配送が必要なことを表示する。発送ボタンを作る
     *  2: 配送状態を表示する
     *  3: 購入者が受け取りボタンを押していないことを表示する
     *  4: 取引完了
     * 
     * 購入者
     *  0: 支払いフォームを表示する
     *  1: 出品者の配送待ちを表示する
     *  2: 配送状態を表示する
     *  3: 受け取りボタンを表示する
     *  4: 取引完了
     */
    $status = $transactions['status'];
    switch ($status) {
      case 0:
        // TODO: 住所情報があれば渡す
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
    echo "ID: {$id}の取引を登録";
    // idの正当性

    // ログイン確認
    if (!$this->auth->check()) {
      $this->push("auth/login");
    }

    $dba = DBAccess::getInstance();
    // 自分の出品ではない
    // 取引中(1 or 2)になっていない

    // productsを取引中(1)に変える
    $dba->query("UPDATE products SET status = 1 WHERE id = ? LIMIT 1;", [$id]);

    // 新規取引を登録する
    $user = $this->auth->getUser();
    $dba->query("INSERT INTO transactions (product_id, user_id) VALUES (?, ?);", [$id, $user->getId()]);
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

    // 入力値の検証

    $dba = DBAccess::getInstance();
    // 購入者であることを確認

    // TODO: アドレステーブルにUPSERT
    $user = $this->auth->getUser();
    $user_id = $user->getId();

    /**
     * INSERT INTO addresses (user_id, postcode, prefecture, city, chomei, building, room_number) 
     *    VALUES (1, ?, ?, ?, ?, ?,  ?) 
     *  ON DUPLICATE KEY UPDATE 
     *    postcode = ? ....
     */

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
    // 出品者であることを確認

    // transactionsテーブルの状態を2(配送中)に
    $dba->query("UPDATE transactions SET status = 2 WHERE id = ? LIMIT 1;", [$id]);

    // deliveriesテーブルに配送開始時間を保存
    $dba->query("INSERT INTO deliveries (transaction_id) VALUES (?);", [$id]);

    // 取引画面に戻る
    $this->push("transactions/${id}");
  }

  /**
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
      $this->view("transactions/delivery.php", ['status' => $time_diff]);
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
    // 購入者であることを確認

    // transactionの状態を4に、完了日を更新
    $dba->query("UPDATE transactions SET status = 4 WHERE id = ? LIMIT 1;", [$id]);

    // 取引画面に戻る
    $this->push("transactions/${id}");
  }
}
