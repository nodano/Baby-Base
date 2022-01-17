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
   * バリデートの関数
   */

  /**
   * 入力チェックの関数
   */
  public function validate_Trim()
  {
    /** 空白文字の削除/空文字チェック
     * if(isset($_POST['~~~'])){ // $_POSTでデータが送られている場合
     *    $~~~ = trim($_POST['~~~']); // trim()で空白文字のみを削除
     * }else{
     *    $~~~ = ""; //$_POSTで送られていない場合
     * }
     */

    if (isset($_POST['name'])) {
      $name = trim($_POST['name']);
    } else {
      $name = "";
    }

    if (isset($_POST['username'])) {
      $username = trim($_POST['username']);
    } else {
      $username = "";
    }

    if (isset($_POST['email'])) {
      $email = trim($_POST['email']);
    } else {
      $email = "";
    }

    if (isset($_POST['password'])) {
      $password = trim($_POST['password']);
    } else {
      $password = "";
    }

    if (isset($_POST['password'])) {
      $password2 = trim($_POST['password2']);
    } else {
      $password2 = "";
    }

    // return [$name, $username, $email, $password, $password2];
    $array_Post = array($name, $username, $email, $password, $password2);

    return $array_Post;
  }

  //文字数は足りているか
  public function validete_WordCount($Word, $countMin, $countMax)
  {
    if (mb_strlen($Word) < $countMax + 1 && mb_strlen($Word) > $countMin - 1) {
      //2文字以上8文字未満の場合の処理
      return true;
    } else {
      //文字数が規定の値でなかった場合
      return $this->push("auth/signup");
    }
  }

  public function validate_JP($Word)
  {
    $validate_JP = "/^[ぁ-んァ-ヶ一-龠々]+$/u";
    if (preg_match($validate_JP, $Word)) {
      // 日本語の場合
      return true;
    } else {
      // 日本語ではない場合
      return $this->push("auth/signup");
    }
  }

  public function validate_Eng($Word)
  {
    $validate_Eng = "/^[a-zA-Z0-9]+$/";
    // 英数字であるかチェック
    if (preg_match($validate_Eng, $Word)) {
      // 英数字の場合
      return True;
    } else {
      // 英数字ではない場合
      return $this->push("auth/signup");
    }
  }

  public function validate_Mail($Word)
  {
    $validate_Mail = "/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/";
    if (preg_match($validate_Mail, $Word)) {
      // メールの場合
      return True;
    } else {
      // メールではない場合
      return $this->push("auth/signup");
    }
  }

  public function pass_check($password, $password2)
  {
    if ($password == $password2) {
      // パスワードが一致していた場合
      return true;
    } else {
      // パスワードの不一致
      return $this->push("auth/signup");
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
    $validated_array = $this->validate_Trim();

    $name = $validated_array[0];
    $username = $validated_array[1];
    $email = $validated_array[2];
    $password = $validated_array[3];
    $password2 = $validated_array[4];

    if (empty($name) || empty($username) || empty($email) || empty($password)) {
      // いずれかに文字列が格納されていない場合
      $this->push("auth/signup");
    }

    //TODO: 文字の形式
    //文字数チェック
    $this->validete_WordCount($username, 2, 8);
    $this->validete_WordCount($password, 2, 8);

    //英数字チェック
    $this->validate_Eng($username);
    $this->validate_Eng($password);

    //日本語チェック
    $this->validate_JP($name);


    //メールチェック
    $this->validate_Mail($email);

    //TODO: パスワードの一致
    $this->pass_check($password, $password2);

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
    }    // 入力値の確認


    // TODO: 空文字
    // TODO: 文字の形式
    // TODO: パスワードの一致

    // TODO: 空文字 
    $validated_array = $this->validate_Trim();
    if (empty($name) || empty($username) || empty($email) || empty($password)) {
      // いずれかに文字列が格納されていない場合
      $this->push("auth/signup");
    }

    $name = $validated_array[0];
    $username = $validated_array[1];
    $email = $validated_array[2];
    $password = $validated_array[3];
    $password2 = $validated_array[4];

    //TODO: 文字の形式
    //文字数チェック
    $this->validete_WordCount($username, 2, 8);
    $this->validete_WordCount($password, 2, 8);

    //英数字チェック
    $this->validate_Eng($username);
    $this->validate_Eng($password);

    //日本語チェック
    $this->validate_JP($name);


    //メールチェック
    $this->validate_Mail($email);

    //TODO: パスワードの一致
    $this->pass_check($password, $password2);


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
    }    // 入力値の確認


    // TODO: 空文字
    // TODO: 文字の形式
    // TODO: パスワードの一致

    // TODO: 空文字 
    $validated_array = $this->validate_Trim();
    if (empty($username) || empty($password)) {
      // いずれかに文字列が格納されていない場合
      $this->push("auth/signup");
    }

    $username = $validated_array[1];
    $password = $validated_array[3];

    //TODO: 文字の形式

    //英数字チェック
    $this->validate_Eng($username);
    $this->validate_Eng($password);

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
