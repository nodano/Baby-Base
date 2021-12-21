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

  protected function view(string $path)
  {
    require_once ROOT . "/resources/views/" . $path;
  }

  protected function push(string $path)
  {
    header("Location:" . PUBLIC_URL . $path);
    exit();
  }
}
