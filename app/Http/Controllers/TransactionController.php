<?php

namespace Http\Controllers;

use Http\Controllers\Controller;

class TransactionController extends Controller
{
  /**
   * GET transactions/[:id]
   *
   * @param integer $id
   * @return void
   */
  public function fetchByID(int $id)
  {
    echo "ID: ${id}の取引表示";
    // idの正当性

    // ログイン確認

    /**
     * 本人確認
     * 
     * 出品者or取引者とログインしている人が同一か?
     */

    // DB取得

    $this->view("transaction.php");
  }

  /**
   * POST transactions/[:id]
   * 
   * @param integer $id - product_id
   */
  public function transaction(int $id)
  {
    echo "ID: {$id}の取引を登録";
    // idの正当性

    // ログイン確認

    // productsを取引中(1)に変える

    // 新規取引を登録する

    // 新規取引のidに遷移
  }
}
