<?php

namespace Http\Controllers;

use Auth\User\LoginUser;
use Database\DBAccess;
use Http\Controllers\Controller;
use Validate;

require "./Validate.php";

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

    $Validate = new Validate;

    // 入力値の確認

    $validated_array = $Validate->validateTrim();

    $name = $validated_array[0];
    $username = $validated_array[1];
    $email = $validated_array[2];
    $password = $validated_array[3];
    $password2 = $validated_array[4];

    if (empty($name) || empty($username) || empty($email) || empty($password)) {
      $this->push("auth/signup");
    }

    if ($Validate->valideteWordCount($username, 2, 8) == false) {
      $this->push("auth/signup");
    }

    if ($Validate->valideteWordCount($password, 2, 8) == false) {
      $this->push("auth/signup");
    }

    if ($Validate->validateEng($username) == false) {
      $this->push("auth/signup");
    }
    if ($Validate->validateEng($password) == false) {
      $this->push("auth/signup");
    }

    if ($Validate->validateJP($name) == false) {
      $this->push("auth/signup");
    }

    if ($Validate->validateMail($email) == false) {
      $this->push("auth/signup");
    }

    if ($Validate->passCheck($password, $password2) == false) {
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
    $Validate = new Validate;

    $validated_array = $Validate->validateTrim();
    if (empty($name) || empty($username) || empty($email) || empty($password)) {
      $this->push("auth/signup");
    }

    $name = $validated_array[0];
    $username = $validated_array[1];
    $email = $validated_array[2];
    $password = $validated_array[3];
    $password2 = $validated_array[4];

    if ($Validate->valideteWordCount($username, 2, 8) == false) {
      $this->push("auth/signup");
    }

    if ($Validate->valideteWordCount($password, 2, 8) == false) {
      $this->push("auth/signup");
    }

    if ($Validate->validateEng($username) == false) {
      $this->push("auth/signup");
    }
    if ($Validate->validateEng($password) == false) {
      $this->push("auth/signup");
    }

    if ($Validate->validateJP($name) == false) {
      $this->push("auth/signup");
    }

    if ($Validate->validateMail($email) == false) {
      $this->push("auth/signup");
    }

    if ($Validate->passCheck($password, $password2) == false) {
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
    $Validate = new Validate;

    $validated_array = $Validate->validateTrim();
    if (empty($username) || empty($password)) {
      $this->push("auth/login");
    }

    $username = $validated_array[1];
    $password = $validated_array[3];

    if ($Validate->valideteWordCount($username, 2, 8) == false) {
      $this->push("auth/login");
    }

    if ($Validate->valideteWordCount($password, 2, 8) == false) {
      $this->push("auth/login");
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
