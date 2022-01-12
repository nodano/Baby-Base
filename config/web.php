<?php
$router = new AltoRouter();
$router->setBasePath('/Baby-Base/public/');

$router->map('GET', '', 'Http\Controllers\WelcomController::get', 'welcom');

$router->map('GET', 'auth/signup', 'Http\Controllers\AuthController::renderSignup');
$router->map('POST', 'auth/signup/confirm', 'Http\Controllers\AuthController::confirm');
$router->map('POST', 'auth/signup', 'Http\Controllers\AuthController::signup');

$router->map('GET', 'auth/login', 'Http\Controllers\AuthController::renderLogin');
$router->map('POST', 'auth/login', 'Http\Controllers\AuthController::auth');

$router->map('GET', 'auth/logout', 'Http\Controllers\AuthController::logout');

$router->map('GET', 'users/[i:id]', 'Http\Controllers\UserController::fetchByID', 'users-detail');

$router->map('GET', 'mypage', 'Http\Controllers\UserController::mypage');

$router->map('GET', 'mypage/info', 'Http\Controllers\UserController::info');
$router->map('POST', 'mypage/info', 'Http\Controllers\UserController::infoUpdate');

$router->map('GET', 'mypage/profit', 'Http\Controllers\UserController::profit');

$router->map('GET', 'mypage/favorite', 'Http\Controllers\UserController::favorite');
$router->map('GET', 'mypage/block', 'Http\Controllers\UserController::block');

$router->map('GET', 'listing', 'Http\Controllers\ListingController::renderListing');
$router->map('POST', 'listing/confirm', 'Http\Controllers\ListingController::confirm');
$router->map('POST', 'listing', 'Http\Controllers\ListingController::listing');


$router->map('GET', 'products', 'Http\Controllers\ProductController::get');

$router->map('GET', 'products/[i:id]', 'Http\Controllers\ProductController::fetchByID');
$router->map('GET', 'products/[i:id]/update', 'Http\Controllers\ProductController::renderUpdate');
$router->map('POST', 'products/[i:id]/update', 'Http\Controllers\ProductController::update');

$router->map('GET', 'transactions/[i:id]', 'Http\Controllers\TransactionController::fetchByID');
$router->map('POST', 'transactions/[i:id]', 'Http\Controllers\TransactionController::transaction');

$router->map('POST', 'transactions/[i:id]/payments', 'Http\Controllers\TransactionController::payments'); // 支払い処理
$router->map('POST', 'transactions/[i:id]/send', 'Http\Controllers\TransactionController::send'); // 発送完了処理
$router->map('POST', 'transactions/[i:id]/received', 'Http\Controllers\TransactionController::received'); // 受け取り完了処理
