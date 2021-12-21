<?php

namespace Http\Controllers;

use Http\Controllers\Controller;

class AuthController extends Controller {
  /**
   * GET auth/signup
   *
   * @return void
   */
  public function renderSignup() {
    if (!false) {
      $this->view("signup/index.php");
    } else {
      $this->push("mypage");
    }
  }

  /**
   * GET auth/signup/confirm
   *
   * @return void
   */
  public function confirm() {
    // 入力値の確認

    // ミスがあれば 戻る

    $this->view("signup/confirm.php");
  }

  /**
   * POST auth/signup
   *
   * @return void
   */
  public function signup() {
    echo "サインアップ実行";
    // 入力値の確認

    // ハッシュ化

    // DB登録

    $this->push("mypage");
  }

  /**
   * GET auth/login
   *
   * @return void
   */
  public function renderLogin() {
    if (!false) {
      $this->view("login.php");
    } else {
      $this->push("mypage");
    }
  }

  /**
   * POST auth/login
   *
   * @return void
   */
  public function auth() {
    echo "ログイン実行";
    // 入力値の確認

    // DBから取得

    // パスワードの認証

    $this->push("mypage");
  }
}