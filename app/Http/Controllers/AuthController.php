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

    //正規パターン
    $validate_JP = "/^[ぁ-んァ-ヶ一-龠々]+$/u";
    $validate_Eng = "/^[a-zA-Z0-9]+$/";
    $validate_Mail = "/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/";


    // TODO: 空文字
    // TODO: 文字の形式
    // TODO: パスワードの一致

    // TODO: 空文字 
    // 空白の削除
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);

    // 文字列が格納されているか
    if (empty($name) || empty($username) || empty($email) || empty($password)) {
      // いずれかに文字列が格納されていない場合
      $this->push("auth/signup");
    }

    //TODO: 文字の形式
    //文字数は足りているか
    if (mb_strlen($password) < 8 && mb_strlen($password) > 2) {
      //2文字以上8文字未満の場合の処理
    }

    // 英数字であるかチェック
    if (preg_match("$validate_Eng", $username)) {
      // 英数字の場合
    } else {
      // 英数字ではない場合
      $this->push("auth/signup");
    }

    if (preg_match("$validate_Eng", $password)) {
      // 英数字の場合
    } else {
      // 英数字ではない場合
      $this->push("auth/signup");
    }

    if (preg_match("$validate_Eng", $password2)) {
      // 英数字の場合
    } else {
      // 英数字ではない場合
      $this->push("auth/signup");
    }

    //日本語チェック
    if (preg_match("$validate_JP", $name)) {
      // 日本語の場合
    } else {
      // 日本語ではない場合
      $this->push("auth/signup");
    }

    //メールチェック
    if (preg_match("$validate_Mail", $email)) {
      // 英数字の場合
    } else {
      // 英数字ではない場合
      $this->push("auth/signup");
    }

    //TODO: パスワードの一致
    if ($password == $password2) {
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
    //正規パターン
    $validate_JP = "/^[ぁ-んァ-ヶ一-龠々]+$/u";
    $validate_Eng = "/^[a-zA-Z0-9]+$/";
    $validate_Mail = "/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/";
    // TODO: 空文字
    // TODO: 文字の形式

    // TODO: 空文字 

    // 文字列が格納されているか    
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);

    // 文字列が格納されているか
    if (empty($name) || empty($username) || empty($email) || empty($password)) {
      // いずれかに文字列が格納されていない場合
      $this->push("auth/signup");
    }

    //TODO: 文字の形式
    //文字数は足りているか
    if (mb_strlen($password) < 8 && mb_strlen($password) > 2) {
      //2文字以上8文字未満の場合の処理
    }

    // 英数字であるかチェック
    if (preg_match("$validate_Eng", $username)) {
      // 英数字の場合
    } else {
      // 英数字ではない場合
      $this->push("auth/signup");
    }

    if (preg_match("$validate_Eng", $password)) {
      // 英数字の場合
    } else {
      // 英数字ではない場合
      $this->push("auth/signup");
    }

    if (preg_match("$validate_Eng", $password2)) {
      // 英数字の場合
    } else {
      // 英数字ではない場合
      $this->push("auth/signup");
    }

    //日本語チェック
    if (preg_match("$validate_JP", $name)) {
      // 日本語の場合
    } else {
      // 日本語ではない場合
      $this->push("auth/signup");
    }

    //メールチェック
    if (preg_match("$validate_Mail", $email)) {
      // 英数字の場合
    } else {
      // 英数字ではない場合
      $this->push("auth/signup");
    }

    //TODO: パスワードの一致
    if ($password == $password2) {
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
    //正規パターン
    $validate_JP = "/^[ぁ-んァ-ヶ一-龠々]+$/u";
    $validate_Eng = "/^[a-zA-Z0-9]+$/";
    $validate_Mail = "/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/";
    // TODO: 空文字

    // TODO: 空文字 
    // 空白の削除
    //TODO: 文字の形式
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // 文字列が格納されているか
    if (empty($username) || empty($password)) {
      // いずれかに文字列が格納されていない場合
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
