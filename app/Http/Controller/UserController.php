<?php

namespace HTTP\Controller;

class UserController {

  /**
   * GET users/[:id]
   *
   * @param [int] $id
   * @return void
   */
  public function fetchByID($id) {
    echo "ID: {$id}のユーザーページを表示";
    // 値検証

    // DB取得

    // require_once
    require_once ROOT . "/view/user/user.php";
  }

  /**
   * GET mypage
   *
   * @return void
   */
 public function mypage() {
  // ログイン確認
  // DB取得
  // require_once
  require_once ROOT . "/view/user/index.php";
}

  /**
   * GET mypage/info
   *
   * @return void
   */
 public function info() {
  // ログイン確認
  // DB取得
  // require_once
  require_once ROOT . "/view/user/info.php";
 }

  /**
   * POST mypage/info
   *
   * @return void
   */
 public function infoUpdate() {
   echo "アップデート実行";
  // ログイン確認
  // 入力検証
  // DB Update
  // 遷移
 }

  /**
   * GET mypage/profit
   *
   * @return void
   */
 public function profit() {
  // ログイン確認
  // DB取得
  // require_once
  require_once ROOT . "/view/user/profit.php";
 }

  /**
   * GET mypage/favorite
   *
   * @return void
   */
 public function favorite() {
  // ログイン確認
  // DB取得
  // require_once
  require_once ROOT . "/view/user/favorite.php";
 }

  /**
   * GET mypage/block
   *
   * @return void
   */
 public function block() {
  // ログイン確認
  // DB取得
  // require_once
  require_once ROOT . "/view/user/block.php";
 }

}