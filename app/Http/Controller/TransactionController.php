<?php

namespace HTTP\Controller;

class TransactionController {
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

    // require_once
    require_once ROOT . "/view/transaction.php";
  }
}