<?php

namespace Http\Controllers;

use Http\Controllers\Controller;

class TransactionController extends Controller {
  /**
   * GET transactions/[:id]
   *
   * @param integer $id
   * @return void
   */
  public function fetchByID(int $id) {
    echo "ID: ${id}の取引表示";
    // ログイン確認

    // 本人確認

    // DB取得

    $this->view("transaction.php");
  }
}