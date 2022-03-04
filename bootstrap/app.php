<?php

/**
 * require_onceなどで呼び出す部分をルートからのパスに
 */
define("ROOT", realpath(__DIR__ . "/../"));
ini_set('include_path', get_include_path() . PATH_SEPARATOR . ROOT);

require_once(ROOT . "/vendor/autoload.php");

/**
 * URL
 */
$protocol = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
$host = $_SERVER['HTTP_HOST'];
$path = $_SERVER['REQUEST_URI'];

$root_path = strstr($path, "public/", true);
$public_path = $root_path . "public/";
$assets_path = $root_path . "resources/assets/";
define("ROOT_URL", $protocol . $host . $root_path);
define("PUBLIC_URL", $protocol . $host . $public_path);
define("ASSETS_URL", $protocol . $host . $assets_path);

/**
 * ルーティング
 */
require_once(ROOT . "/config/web.php");

// ルーティングと一致したものを実行
$match = $router->match();
if ($match !== false) {
  if (is_callable($match['target'])) {
    $match['target']();
  } else {
    try {
      $params = explode("::", $match['target']);
      $action = new $params[0]();
      call_user_func_array(array($action, $params[1]), $match['params']);
    } catch (Exception $e) {
      require_once ROOT . "/resources/views/header.php";
      require_once ROOT . "/resources/views/error.php";
      // echo $e->getMessage(); // 不明なエラーページに移動したら、っこのコメントアウトを外す
      require_once ROOT . "/resources/views/footer.php";
    }
  }
} else {
  require_once ROOT . "/resources/views/header.php";
  require_once ROOT . "/resources/views/404.php";
  require_once ROOT . "/resources/views/footer.php";
}
