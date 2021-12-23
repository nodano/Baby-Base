<?php

namespace Http\Controllers;

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
    echo "ID: {$id}のユーザーページを表示";
    // 値検証

    // DB取得

    $this->view("user/user.php");
  }

  /**
   * GET mypage
   *
   * @return void
   */
  public function mypage()
  {
    // ログイン確認
    // DB取得
    $this->view("user/index.php");
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
