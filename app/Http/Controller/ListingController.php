<?php

namespace HTTP\Controller;

class ListingController {
  /**
   * GET listing
   *
   * @return void
   */
  public function renderListing() {
    // ログイン確認

    // view/listing/index.phpのrequire_once
    require_once ROOT . "/view/listing/index.php";
  }

  /**
   * GET listing/confirm
   *
   * @return void
   */
  public function confirm() {
    // ログイン確認

    // 入力チェック

    // view/listing/confirm.phpのrequire_once
    require_once ROOT . "/view/listing/confirm.php";
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

    // PUBLIC_URL . products/登録したIDに遷移
  }
}