<?php

namespace Http\Controllers;

use Auth\Auth;

class Controller
{
  protected Auth $auth;
  public function __construct()
  {
    $this->auth = new Auth();
  }

  /**
   * viewファイルの読み込み
   *
   * @param string $path
   * @param array|null $params viewに渡したい値 --- キー名 もしくは $params['キー名']で取得可能 $_POSTなどの値は不要
   * @return void
   */
  protected function view(string $path, array $params = null)
  {
    // 画面に渡す値の定義
    if ($params) {
      foreach ($params as $key => $value) {
        if (!preg_match("/[a-zA-Z_][a-zA-Z0-9_]*/", $key)) {
          continue;
        }
        $$key = $value;
      }
    }

    // 全画面に渡す値の定義
    $auth = ['is_login' => $this->auth->check(), 'user' => $this->auth->getUser()];


    // ヘッダー、メインコンテンツ、フッター画面の読み込み
    require_once ROOT . "/resources/views/header.php";
    require_once ROOT . "/resources/views/" . $path;
    require_once ROOT . "/resources/views/footer.php";
  }

  protected function push(string $path)
  {
    header("Location:" . PUBLIC_URL . $path);
    exit();
  }
}
