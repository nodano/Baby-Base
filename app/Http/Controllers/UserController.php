<?php

namespace Http\Controllers;

use Auth\User\LoginUser;
use Database\DBAccess;
use Http\Controllers\Controller;

class UserController extends Controller
{

  /**
   * GET users/[:id]
   *
   * @param [int] $id
   * @return void
   */
  public function fetchByID($id)
  {
    if ($this->auth->check()) {
      // もし自分のページなら遷移する
      $user = $this->auth->getUser();
      $user_id = $user->getId();
      if ($id == $user_id) {
        $this->push("mypage");
      }
    }

    $params = $this->getUserPageInfo($id);

    // ユーザー情報の取得に失敗していれば
    if (!$params['user']) {
      $this->push("");
    }

    $this->view("user/user.php", $params);
  }

  /**
   * GET mypage
   *
   * @return void
   */
  public function mypage()
  {
    // ログイン確認
    if (!$this->auth->check()) {
      $this->push("auth/login");
    }

    $user = $this->auth->getUser();
    $user_id = $user->getId();
    $params = $this->getUserPageInfo($user_id);

    $dba = DBAccess::getInstance();

    // 取引が終わっていない かつ 購入者または出品者 の商品取得
    $stmt = $dba->query("SELECT DISTINCT t.id AS id, p.name, p.price, p.status, pic.path FROM transactions AS t LEFT OUTER JOIN products AS p ON t.product_id = p.id LEFT OUTER JOIN pictures AS pic ON p.id = pic.product_id WHERE (t.user_id = ? OR p.user_id = ?) AND t.status < 4 GROUP BY p.id LIMIT 30;", [$user_id, $user_id]);
    $params['transaction_products'] = $stmt->fetchAll();

    // 取引が終わっている かつ 購入者または出品者 の商品取得
    $stmt = $dba->query("SELECT DISTINCT t.id AS id, p.name, p.price, p.status, pic.path FROM transactions AS t LEFT OUTER JOIN products AS p ON t.product_id = p.id LEFT OUTER JOIN pictures AS pic ON p.id = pic.product_id WHERE (t.user_id = ? OR p.user_id = ?) AND t.status = 4 GROUP BY p.id LIMIT 30;", [$user_id, $user_id]);
    $params['completed_products'] = $stmt->fetchAll();

    $this->view("user/index.php", $params);
  }

  /**
   * GET mypage/info
   *
   * @return void
   */
  public function info()
  {
    // ログイン確認
    if (!$this->auth->check()) {
      $this->push("auth/login");
    }

    $user = $this->auth->getUser();
    $user_id = $user->getId();

    $dba = DBAccess::getInstance();

    // usersテーブルからパスワード以外の情報を取得する
    $stmt = $dba->query("SELECT username, name, email FROM users WHERE id = ?", [$user_id]);
    $user = $stmt->fetch();

    $params = ['user' => $user];
    $this->view("user/info.php", $params);
  }

  /**
   * POST mypage/info
   *
   * @return void
   */
  public function infoUpdate()
  {
    // ログイン確認
    if (!$this->auth->check()) {
      $this->push("auth/login");
    }

    $user = $this->auth->getUser();
    $user_id = $user->getId();

    // 入力検証

    $dba = DBAccess::getInstance();
    // 重複確認

    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $dba->query("UPDATE users SET username = ?, password = ?, name = ?, email = ? WHERE id = ? LIMIT 1;", [$_POST['username'], $hashed_password, $_POST['name'], $_POST['email'], $user_id]);

    $updateUser = new LoginUser($user_id, $_POST['username']);
    $this->auth->login($updateUser);

    $this->push("mypage");
  }

  /**
   * GET mypage/profit
   *
   * @return void
   */
  public function profit()
  {
    // ログイン確認
    if (!$this->auth->check()) {
      $this->push("auth/login");
    }

    $user = $this->auth->getUser();
    $user_id = $user->getId();

    $dba = DBAccess::getInstance();

    // transfersテーブルから商品名と利益を取得
    $stmt = $dba->query("SELECT transfers.amount, products.name FROM transfers LEFT OUTER JOIN transactions ON transfers.transaction_id = transactions.id LEFT OUTER JOIN products ON transactions.product_id = products.id WHERE products.user_id = ?;", [$user_id]);
    $transfers = $stmt->fetchAll();

    $total = 0;
    foreach ($transfers as $transfer) {
      $total += $transfer['amount'];
    }

    $params = ['transfers' => $transfers, 'total' => $total];
    $this->view("user/profit.php", $params);
  }

  /**
   * GET mypage/favorite
   *
   * @return void
   */
  public function favorite()
  {
    // ログイン確認
    if (!$this->auth->check()) {
      $this->push("auth/login");
    }

    //ユーザIDの取得
    $user = $this->auth->getUser();
    $user_id = $user->getId();

    $dba = DBAccess::getInstance();
    $stmt = $dba->query("SELECT products.id,name,price,status,path, 
    CASE 
      WHEN path LIKE '%0.png' THEN 'TOP'
      ELSE 'NO' 
      END 
    FROM products INNER JOIN pictures ON products.id = pictures.product_id
    INNER JOIN favorite ON products.id = favorite.products_id
    
    WHERE 
    (CASE WHEN path LIKE '%0.png' THEN 'TOP' ELSE 'NO' END)
     = 'TOP'
                          AND favorite.user_id = ? LIMIT 30;", [$user_id]);
    $products = $stmt->fetchAll();




    $params = ["products" => $products];

    $this->view("user/favorite.php", $params);
  }

  /**
   * GET mypage/block
   *
   * @return void
   */
  public function block()
  {
    // ログイン確認
    if (!$this->auth->check()) {
      $this->push("auth/login");
    }

    // ブロックしているユーザーの一覧を取得
    $user = $this->auth->getUser();
    $user_id = $user->getId();

    $dba = DBAccess::getInstance();

    $stmt = $dba->query("SELECT users.id, username FROM block INNER JOIN users ON block.to_user_id = users.id WHERE from_user_id = ?;", [$user_id]);
    $blockList = $stmt->fetchAll();

    $stmt = $dba->query("SELECT count(*) FROM block INNER JOIN users ON block.to_user_id = users.id WHERE from_user_id = ?;", [$user_id]);
    $count = $stmt->fetch();
    $blockCount = $count['count(*)'];

    $params = ["blockList" => $blockList, "blockCount" => $blockCount, "user_id" => $user_id];

    // DB取得
    $this->view("user/block.php", $params);
  }

  public function userBlock($id)
  {

    $dba = DBAccess::getInstance();

    echo $id;
    // ログイン確認
    if (!$this->auth->check()) {
      $this->push("auth/login");
    }

    //ユーザIDの取得
    $user = $this->auth->getUser();
    $user_id = $user->getId();

    // block
    $stmt = $dba->query("SELECT count(*) FROM block WHERE from_user_id = ? && to_user_id = ?;", [$user_id, $id]);
    $BlockStatus = $stmt->fetch();

    if ($BlockStatus["count(*)"] == 1) {
      //DBから削除
      $dba->query("DELETE FROM block WHERE from_user_id = ? && to_user_id = ?;", [$user_id, $id]);
    } else {
      //DBに登録
      $dba->query("INSERT INTO block(from_user_id, to_user_id) VALUES(?,?);", [$user_id, $id]);
    }

    $this->push("users/$id");
  }

  public function blocklist($id)
  {
    $dba = DBAccess::getInstance();

    echo $id;
    // ログイン確認
    if (!$this->auth->check()) {
      $this->push("auth/login");
    }

    //ユーザIDの取得
    $user = $this->auth->getUser();
    $user_id = $user->getId();

    // block
    $stmt = $dba->query("SELECT count(*) FROM block WHERE from_user_id = ? && to_user_id = ?;", [$user_id, $id]);
    $BlockStatus = $stmt->fetch();

    if ($BlockStatus["count(*)"] == 1) {
      //DBから削除
      $dba->query("DELETE FROM block WHERE from_user_id = ? && to_user_id = ?;", [$user_id, $id]);
    } else {
      //DBに登録
      $dba->query("INSERT INTO block(from_user_id, to_user_id) VALUES(?,?);", [$user_id, $id]);
    }

    $this->push("mypage/block");
  }

  /**
   * マイページや会員ページの情報を取得する
   *
   * @param integer $id
   * @return array
   */
  private function getUserPageInfo(int $id)
  {
    $blockDisplay = false;
    $BlockStatus = false;
    $blockedStatus = false;
    $blockDisplayError = false;
    $dba = DBAccess::getInstance();

    // ログイン確認
    if ($this->auth->check()) {
      $blockDisplay = true;
      //ユーザIDの取得
      $user = $this->auth->getUser();
      $user_id = $user->getId();


      //取引確認
      $stmt = $dba->query("SELECT COUNT(*) FROM transactions INNER JOIN products ON transactions.product_id = products.id 
                          WHERE transactions.status != 4 && ((products.user_id = ? && transactions.user_id = ?) ||
                          (transactions.user_id = ? && products.user_id = ?));", [$user_id, $id, $user_id, $id]);

      $transacttionCount = $stmt->fetch();

      if ($transacttionCount['COUNT(*)'] > 0) {
        $blockDisplayError = true;
      }

      // block
      $stmt = $dba->query("SELECT count(*) FROM block WHERE from_user_id = ? && to_user_id = ?;", [$id, $user_id]);
      $BlockStatus = $stmt->fetch();

      if ($BlockStatus["count(*)"] == 1) {
        $blockedStatus = true;
      }

      // block
      $stmt = $dba->query("SELECT count(*) FROM block WHERE from_user_id = ? && to_user_id = ?;", [$user_id, $id]);
      $BlockStatus = $stmt->fetch();

      if ($BlockStatus["count(*)"] == 1) {
        $BlockStatus = true;
      } else {
        $BlockStatus = false;
      }
    }
    // ユーザー情報の取得
    $stmt = $dba->query("SELECT id, username FROM users WHERE id = ?;", [$id]);
    $user = $stmt->fetch();

    // テーブルから出品した商品をすべて取得
    $stmt = $dba->query("SELECT DISTINCT products.id, name, price, products.status, path FROM products LEFT OUTER JOIN pictures ON products.id = pictures.product_id WHERE products.user_id = ? AND (CASE WHEN path LIKE '%0.png' THEN 'TOP' ELSE 'NO' END) = 'TOP' LIMIT 30;", [$id]);
    $products = $stmt->fetchAll();

    return ['user' => $user, 'products' => $products, "blockDisplay" => $blockDisplay, "blockStatus" => $BlockStatus, "blockedStatus" => $blockedStatus, "blockDisplayError" => $blockDisplayError];
  }
}
