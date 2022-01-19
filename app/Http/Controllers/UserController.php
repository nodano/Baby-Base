<?php

namespace Http\Controllers;

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
    // もし自分のページなら遷移する
    if ($this->auth->check()) {
      $user = $this->auth->getUser();
      if ($id == $user->getId()) {
        $this->push("mypage");
      }
    }

    // TODO: 共通部分をまとめる???

    $dba = DBAccess::getInstance();

    $stmt = $dba->query("SELECT id, username FROM users WHERE id = ?;", [$id]);
    $user = $stmt->fetch();
    // ユーザー情報の取得に失敗したら
    if (!$user) {
      $this->push("");
    }

    // テーブルから出品した商品を取得
    $stmt = $dba->query("SELECT DISTINCT products.id, name, price, status, path FROM products LEFT OUTER JOIN pictures ON products.id = pictures.product_id WHERE products.user_id = ? LIMIT 30;", [$id]);
    $products = $stmt->fetchAll();

    $params = ['user' => $user, 'products' => $products];
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

    $dba = DBAccess::getInstance();

    // テーブルからユーザー情報を取得
    $user = $this->auth->getUser();
    $user_id = $user->getId();

    $stmt = $dba->query("SELECT id, username FROM users WHERE id = ?", [$user_id]);
    $user = $stmt->fetch();

    // テーブルから出品した商品を取得
    $stmt = $dba->query("SELECT DISTINCT products.id, name, price, status, path FROM products LEFT OUTER JOIN pictures ON products.id = pictures.product_id WHERE products.user_id = ? LIMIT 30;", [$user_id]);
    $products = $stmt->fetchAll();

    $params = ['user' => $user, 'products' => $products];
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
    // DB取得
    $this->view("user/info.php");
  }

  /**
   * POST mypage/info
   *
   * @return void
   */
  public function infoUpdate()
  {
    echo "アップデート実行";
    // ログイン確認
    // 入力検証
    // DB Update
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
    // DB取得
    $this->view("user/profit.php");
  }

  /**
   * GET mypage/favorite
   *
   * @return void
   */
  public function favorite()
  {
    // ログイン確認
    // DB取得
    $this->view("user/favorite.php");
  }

  /**
   * GET mypage/block
   *
   * @return void
   */
  public function block()
  {
    // ログイン確認
    // DB取得
    $this->view("user/block.php");
  }
}
