<?php

/**
 * require_onceなどで呼び出す部分をルートからのパスに
 */
define("ROOT", realpath(__DIR__ . "/../"));
ini_set('include_path', get_include_path() . PATH_SEPARATOR . ROOT);

/**
 * 設定ファイルの読み込み
 */
define("CONFIG", require_once("config/config.php"));

/**
 * URL
 */
$protocol = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
$host = $_SERVER['HTTP_HOST'];
$path = $_SERVER['REQUEST_URI'];
define("PUBLIC_URL", $protocol . $host . $path);
