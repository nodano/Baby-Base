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
      $this->push("auth/signup?error=blank");
    }

    if ($validate->valideteWordCount($username, 2, 8) == false) {
      $this->push("auth/signup?error=username_length");
    }

    if ($validate->valideteWordCount($password, 2, 8) == false) {
      $this->push("auth/signup?error=password_length");
    }

    if ($validate->validateEng($username) == false) {
      $this->push("auth/signup?error=username_format");
    }
    if ($validate->validateEng($password) == false) {
      $this->push("auth/signup?error=password_format");
    }

    if ($validate->validateJP($name) == false) {
      $this->push("auth/signup?error=name_format");
    }

    if ($validate->validateMail($email) == false) {
      $this->push("auth/signup?error=email_format");
    }

    if ($validate->passCheck($password, $password2) == false) {
      $this->push("auth/signup?error=password_mismatch");
    }

    // 同一ID,Emailがないか
    $dba = DBAccess::getInstance();

    $stmt = $dba->query("SELECT count(*) FROM users WHERE username = ?  LIMIT 1;", [$_POST['username']]);

    $sqlUsername = $stmt->fetch();

    $stmt = $dba->query("SELECT count(*) FROM users WHERE email = ? LIMIT 1;", [$_POST['email']]);

    $sqlEmail = $stmt->fetch();

    if ($sqlUsername["count(*)"] != 0) {
      $this->push("auth/signup?error=username_duplicate");
    }

    if ($sqlEmail["count(*)"] != 0) {
      $this->push("auth/signup?error=email_duplicate");
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
      $this->push("auth/signup?error=blank");
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
    $validate = new Validate;

    $login    = $validate->validateTrim($_POST['login']);
    $password = $validate->validateTrim($_POST['password']);

    if ($login == false || $password == false) {
      $this->push("auth/login?error=blank");
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
