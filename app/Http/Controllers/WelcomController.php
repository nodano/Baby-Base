<?php

namespace Http\Controllers;

use Http\Controllers\Controller;

class WelcomController extends Controller
{
  public function get()
  {
    // おすすめ取得(適当に商品一覧を取得する)

    // 人気取得(適当に商品一覧を取得する)

    // 他(適当に商品一覧を取得する)

    $this->view("index.php");
  }
}
