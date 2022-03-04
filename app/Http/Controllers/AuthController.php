<?php

namespace Http\Controllers;

use Auth\User\LoginUser;
use Database\DBAccess;
use Http\Controllers\Controller;
use Validate;

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

    $validate = new Validate;

    $name       = $validate->validateTrim($_POST['name']);
    $username   = $validate->validateTrim($_POST['username']);
    $email      = $validate->validateTrim($_POST['email']);
    $password   = $validate->validateTrim($_POST['password']);
    $password2  = $validate->validateTrim($_POST['password2']);


    if ($name == false || $username == false || $email == false || $password == false) {
      $error = urlencode("入力されていないフォームがあります。");
      $this->push("auth/signup?error=$error");
    }

    if ($validate->valideteWordCount($username, 2, 8) == false) {
      $error = urlencode("ユーザー名の文字数は、2文字以上8文字以下です。");
      $this->push("auth/signup?error=$error");
    }

    if ($validate->valideteWordCount($password, 2, 8) == false) {
      $error = urlencode("パスワードの文字数は、2文字以上8文字以下です。");
      $this->push("auth/signup?error=$error");
    }

    if ($validate->validateEng($username) == false) {
      $error = urlencode("ユーザー名は、半角英数のみです。");
      $this->push("auth/signup?error=$error");
    }
    if ($validate->validateEng($password) == false) {
      $error = urlencode("パスワードは、半角英数のみです。");
      $this->push("auth/signup?error=$error");
    }

    if ($validate->validateJP($name) == false) {
      $error = urlencode("お名前は、日本語のみです。");
      $this->push("auth/signup?error=$error");
    }

    if ($validate->validateMail($email) == false) {
      $error = urlencode("メールアドレスの形式が間違っています。");
      $this->push("auth/signup?error=$error");
    }

    if ($validate->passCheck($password, $password2) == false) {
      $error = urlencode("入力されたパスワードが一致していません。");
      $this->push("auth/signup?error=$error");
    }

    // 同一ID,Emailがないか
    $dba = DBAccess::getInstance();

    $stmt = $dba->query("SELECT count(*) FROM users WHERE username = ?  LIMIT 1;", [$_POST['username']]);

    $sqlUsername = $stmt->fetch();

    $stmt = $dba->query("SELECT count(*) FROM users WHERE email = ? LIMIT 1;", [$_POST['email']]);

    $sqlEmail = $stmt->fetch();

    if ($sqlUsername["count(*)"] != 0) {
      $error = urlencode("このユーザー名またはメールアドレスは、すでに登録されています。");
      $this->push("auth/signup?error=$error");
    }

    if ($sqlEmail["count(*)"] != 0) {
      $error = urlencode("このユーザー名またはメールアドレスは、すでに登録されています。");
      $this->push("auth/signup?error=$error");
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
    $validate = new Validate;

    $name     = $validate->validateTrim($_POST['name']);
    $username = $validate->validateTrim($_POST['username']);
    $email    = $validate->validateTrim($_POST['email']);
    $password = $validate->validateTrim($_POST['password']);

    if ($name == false || $username == false || $email == false || $password == false) {
      $error = urlencode("入力されていないフォームがあります。");
      $this->push("auth/signup?error=$error");
    }

    // 重複確認
    $dba = DBAccess::getInstance();

    $stmt = $dba->query("SELECT count(*) FROM users WHERE username = ?  LIMIT 1;", [$_POST['username']]);

    $sqlUsername = $stmt->fetch();

    $stmt = $dba->query("SELECT count(*) FROM users WHERE email = ? LIMIT 1;", [$_POST['email']]);

    $sqlEmail = $stmt->fetch();

    if ($sqlUsername["count(*)"] != 0) {
      $error = urlencode("このユーザー名またはメールアドレスは、すでに登録されています。");
      $this->push("auth/signup?error=$error");
    }

    if ($sqlEmail["count(*)"] != 0) {
      $error = urlencode("このユーザー名またはメールアドレスは、すでに登録されています。");
      $this->push("auth/signup?error=$error");
    }

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
    $validate = new Validate;

    $login    = $validate->validateTrim($_POST['login']);
    $password = $validate->validateTrim($_POST['password']);

    if ($login == false || $password == false) {
      $error = urlencode("入力されていないフォームがあります。");
      $this->push("auth/login?error=$error");
    }


    $dba = DBAccess::getInstance();
    $stmt = $dba->query("SELECT id, username, password FROM users WHERE username = ? OR email = ? LIMIT 1;", [$_POST['login'], $_POST['login']]);

    $user = $stmt->fetch();
    if (!$user) {
      $error = urlencode("ユーザー名またはパスワードが間違っています。");
      $this->push("auth/login?error=$error");
    }

    if (password_verify($_POST['password'], $user['password'])) {
      $loginUser = new LoginUser($user['id'], $user['username']);
      $this->auth->login($loginUser);

      $this->push("mypage");
    } else {
      $error = urlencode("ユーザー名またはパスワードが間違っています。");
      $this->push("auth/login?error=$error");
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
