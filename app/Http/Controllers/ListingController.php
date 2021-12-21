<?php

namespace Http\Controllers;

use Http\Controllers\Controller;

class ListingController extends Controller {
  /**
   * GET listing
   *
   * @return void
   */
  public function renderListing() {
    // ログイン確認
    $this->view("listing/index.php");
  }

  /**
   * GET listing/confirm
   *
   * @return void
   */
  public function confirm() {
    // ログイン確認

    // 入力チェック

    $this->view("listing/confirm.php");
  }

  /**
   * POST listing
   *
   * @return void
   */
  public function listing() {
    echo "出品の実行";
    // ログイン確認

    // 入力チェック

    // DB登録

    // $this->push("products/${insertID}");
  }
}