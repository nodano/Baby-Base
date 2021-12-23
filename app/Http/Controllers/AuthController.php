<?php

namespace Http\Controllers;

use Auth\User\LoginUser;
use Database\DBAccess;
use Http\Controllers\Controller;

class AuthController extends Controller
{
  /**
   * GET auth/signup
   *
   * @return void
   */
  public function renderSignup()
  {
    if (!$this->auth->check()) {
      $this->view("signup/index.php");
    } else {
      $this->push("mypage");
    }
  }

  /**
   * POST auth/signup/confirm
   *
   * @return void
   */
  public function confirm()
  {
    if ($this->auth->check()) {
      $this->push("mypage");
    }
    // 入力値の確認
    // TODO: 空文字
    // TODO: 文字の形式
    // TODO: パスワードの一致

    // TODO: 空文字 
    // 空白の削除
    $hoge = trim($hoge);
    // 文字列が格納されているか
    if (empty($hoge)) {
      // 文字列が格納されていない場合
      $this->push("auth/signup");
    }


    //TODO: 文字の形式
    //文字数は足りているか
    if (mb_strlen($hoge) < 8) {
      //8文字未満の場合の処理
    }
    // 英数字であるかチェック
    if (preg_match('/^[a-zA-Z0-9]+$/', $hoge)) {
      // 英数字の場合
    } else {
      // 英数字ではない場合
      $this->push("auth/signup");
    }


    // TODO: パスワードの一致
    if ($password == $pass) {
      // パスワードが一致していた場合
    } else {
      // パスワードの不一致
      $this->push("auth/signup");
    }

    // ミスがあれば 戻る
    if (false) {
      $this->push("auth/signup");
    }

    $this->view("signup/confirm.php");
  }

  /**
   * POST auth/signup
   *
   * @return void
   */
  public function signup()
  {
    if ($this->auth->check()) {
      $this->push("mypage");
    }
    // 入力値の確認
    // TODO: 空文字
    // TODO: 文字の形式

    // TODO: 空文字 
    // 空白の削除
    $hoge = trim($hoge);
    // 文字列が格納されているか
    if (empty($hoge)) {
      // 文字列が格納されていない場合
      $this->push("auth/signup");
    }


    //TODO: 文字の形式
    //文字数は足りているか
    if (mb_strlen($hoge) < 8) {
      //8文字未満の場合の処理
    }

    // 英数字であるかチェック
    if (preg_match('/^[a-zA-Z0-9]+$/', $hoge)) {
      // 英数字の場合
    }
    // 日本語であるかチェック
    if (!preg_match("/^[ぁ-んァ-ヶ一-龠々]+$/u", $hoge)) {
      // 日本語の場合
    }

    //Eメールの場合
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      // Eメールの場合

    }


    //TODO: パスワードの一致
    if ($hoge1 == $hoge2) {
      // パスワードが一致していた場合
    } else {
      // パスワードの不一致
      $this->push("auth/signup");
    }


    // ミスがあれば 戻る
    if (false) {
      $this->push("auth/signup");
    }

    // 重複確認
    $dba = DBAccess::getInstance();

    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $dba->query("INSERT INTO users (username, password, name, email) VALUES(?, ?, ?, ?);", [$_POST['username'], $hashed_password, $_POST['name'], $_POST['email']]);

    // $this->auth->register([]);

    $this->push("auth/login");
  }

  /**
   * GET auth/login
   *
   * @return void
   */
  public function renderLogin()
  {
    if (!$this->auth->check()) {
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
  public function auth()
  {
    if ($this->auth->check()) {
      $this->push("mypage");
    }
    // 入力値の確認
    // TODO: 空文字

    // TODO: 空文字 
    // 空白の削除
    $hoge = trim($hoge);


    //TODO: 文字の形式
    // 文字列が格納されているか
    if (empty($hoge)) {
      // 文字列が格納されていない場合
      $this->push("auth/signup");
    }

    // ミスがあれば 戻る
    if (false) {
      $this->push("auth/login");
    }

    $dba = DBAccess::getInstance();
    $stmt = $dba->query("SELECT id, username, password FROM users WHERE username = ? OR email = ? LIMIT 1;", [$_POST['login'], $_POST['login']]);

    $user = $stmt->fetch();
    if (!$user) {
      $this->push("auth/login?error=auth");
    }

    if (password_verify($_POST['password'], $user['password'])) {
      $loginUser = new LoginUser($user['id'], $user['username']);
      $this->auth->login($loginUser);

      $this->push("mypage");
    } else {
      $this->push("auth/login?error=auth");
    }
  }

  /**
   * GET auth/logout
   */
  public function logout()
  {
    $this->auth->logout();
    $this->push("auth/login");
  }
}
