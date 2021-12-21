<?php

namespace Http\Controllers;

use Http\Controllers\Controller;

class ProductController extends Controller {
    /**
     * GET products
     *
     * @return void
     */
    public function get() {
      // 値の取得

      // DBから取得

      $this->view("products/list.php");
    }

  /**
   * GET products/[:id]
   *
   * @param [int] $id
   * @return void
   */
  public function fetchByID($id) {
    echo "ID: ${id}の商品の表示";
    // 値の検証

    // DBから取得

    $this->view("products/index.php");
  }

  /**
   * GET products/[:id]/update
   *
   * @return void
   */
  public function renderUpdate($id) {
    echo "ID: ${id}の商品の更新";
    // ログイン確認

    // 本人確認

    $this->view("products/update.php");
  }

  /**
   * POST products/[:id]/update
   *
   * @return void
   */
  public function update($id) {
    echo "ID: ${id}の商品の出品更新";
    // ログイン確認

    // 本人確認
  }
}