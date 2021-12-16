<?php

namespace HTTP\Controller;

class AuthController {
  /**
   * GET auth/signup
   *
   * @return void
   */
  public function renderSignup() {
    // もしログインしていなかったら
    require_once ROOT . "/view/signup.php";

    // ログインしていれば
      // PUBLIC_URL . mypageに遷移
  }

  /**
   * GET auth/signup/confirm
   *
   * @return void
   */
  public function confirm() {
    // 入力値の確認

    // ミスがあれば 戻る

    // なければ view/signup/confirm.phpのrequire_once
  }

  /**
   * POST auth/signup/confirm
   *
   * @return void
   */
  public function signup() {
    // 入力値の確認

    // ハッシュ化

    // DB登録

    // PUBLIC_URL . mypageに遷移
  }

  /**
   * GET auth/login
   *
   * @return void
   */
  public function renderLogin() {
    // もしログインしていなければ
      // view/login.phpのrequire_once

    // ログインしていれば
      // PUBLIC_URL . mypageに遷移
  }

  /**
   * POST auth/login
   *
   * @return void
   */
  public function auth() {
    // 入力値の確認

    // DBから取得

    // パスワードの認証

    // 遷移
  }
}