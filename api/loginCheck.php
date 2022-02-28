<?php

require_once "../vendor/autoload.php";

use Auth\Auth;

header('Content-Type: application/json; charset=UTF-8');

$auth = new Auth();

$status = "Bad";
$arr = array(
  'status' => $status
);

if ($auth->check()) {
  $arr['status'] = "OK";

  $user = $auth->getUser();
  $arr['id'] = $user->getId();
}

print json_encode($arr, JSON_PRETTY_PRINT);
