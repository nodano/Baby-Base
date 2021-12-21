<?php

namespace Http\Controllers;

class Controller {
  protected function view(string $path) {
    require_once ROOT . "/resources/views/" . $path;
  }

  protected function push(string $path) {
    header("Location:" . PUBLIC_URL . $path);
    exit();
  }
}