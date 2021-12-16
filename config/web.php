<?php
$router = new AltoRouter();
$router->setBasePath('/Baby-Base/public/');

$router->map('GET', '', 'HTTP\Controller\WelcomController::get', 'welcom' );

$router->map('GET', 'auth/signup', 'HTTP\Controller\AuthController::renderSignup');
$router->map('GET', 'auth/signup/confirm', 'HTTP\Controller\AuthController::confirm');
$router->map('POST', 'auth/signup/confirm', 'HTTP\Controller\AuthController::signup');

$router->map('GET', 'auth/login', 'HTTP\Controller\AuthController::renderLogin');
$router->map('POST', 'auth/login', 'HTTP\Controller\AuthController::auth');

$router->map('GET', 'users/[i:id]', 'HTTP\Controller\UserController::fetchByID', 'users-detail' );

$router->map('GET', 'mypage', 'HTTP\Controller\UserController::mypage');

$router->map('GET', 'mypage/info', 'HTTP\Controller\UserController::info');
$router->map('POST', 'mypage/info', 'HTTP\Controller\UserController::infoUpdate');

$router->map('GET', 'mypage/profit', 'HTTP\Controller\UserController::profit');

$router->map('GET', 'mypage/favorite', 'HTTP\Controller\UserController::favorite');
$router->map('GET', 'mypage/block', 'HTTP\Controller\UserController::block');

$router->map('GET', 'listing', 'HTTP\Controller\ListingController::renderListing');
$router->map('GET', 'listing/confirm', 'HTTP\Controller\ListingController::confirm');
$router->map('POST', 'listing/confirm', 'HTTP\Controller\ListingController::listing');


$router->map('GET', 'products', 'HTTP\Controller\ProductController::get');

$router->map('GET', 'products/[i:id]', 'HTTP\Controller\ProductController::fetchByID');
$router->map('GET', 'products/[i:id]/update', 'HTTP\Controller\ProductController::renderUpdate');
$router->map('POST', 'products/[i:id]/update', 'HTTP\Controller\ProductController::update');

$router->map('GET', 'transactions/[i:id]', 'HTTP\Controller\TransactionController::fetchByID');

// 実行
$match = $router->match();
if ($match !== false) {
  if (is_callable($match['target'])) {
      $match['target']();
  } else {
      $params = explode("::", $match['target']);
      $action = new $params[0]();
      call_user_func_array(array($action, $params[1]), $match['params']);
  }
} else {
  // 404
  echo "606";
  header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}