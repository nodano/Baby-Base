<?php

namespace Http\Controllers;

use Auth\Auth;

class Controller
{
  protected Auth $auth;
  public function __construct()
  {
    $this->auth = new Auth();

    echo "↓ Controller.php <br><pre>";
    var_dump($_SESSION);
    echo "</pre><br>";
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
    if ($params) {
      foreach ($params as $key => $value) {
        if (!preg_match("/[a-zA-Z_][a-zA-Z0-9_]*/", $key)) {
          continue;
        }
        $$key = $value;
      }
    }


    require_once ROOT . "/resources/views/" . $path;
  }

  protected function push(string $path)
  {
    header("Location:" . PUBLIC_URL . $path);
    exit();
  }
}
