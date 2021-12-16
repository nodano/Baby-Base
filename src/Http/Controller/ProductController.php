<?php

namespace HTTP\Controller;

class ProductController {
    /**
     * GET products
     *
     * @return void
     */
    public function get() {
      // 値の取得

      // DBから取得

      // require_once
    }

  /**
   * GET products/[:id]
   *
   * @param [int] $id
   * @return void
   */
  public function fetchByID($id) {
    // 値の検証

    // DBから取得

    // require_once
  }

  /**
   * GET products/[:id]/update
   *
   * @return void
   */
  public function renderUpdate($id) {
    // ログイン確認

    // 本人確認

    // require_once
  }

  /**
   * POST products/[:id]/update
   *
   * @return void
   */
  public function update($id) {
    // ログイン確認

    // 本人確認

    // require_once
  }
}