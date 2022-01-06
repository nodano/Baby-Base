<?php

namespace Http\Controllers;

use Database\DBAccess;
use Http\Controllers\Controller;

class ProductController extends Controller
{
  /**
   * GET products
   *
   * @return void
   */
  public function get()
  {
    // もしURLパラメータがあれば、取得と検証

    // データベースから、商品の一覧を取得する
    $products = []; // 本来はfetchAll()したものを代入する

    $params = ['products' => $products];
    $this->view("products/list.php");
  }

  /**
   * GET products/[:id]
   *
   * @param [int] $id
   * @return void
   */
  public function fetchByID($id)
  {
    // 値の検証

    // データベースから商品情報と商品画像を取得
    $dba = DBAccess::getInstance();
    $stmt = $dba->query("SELECT * FROM products WHERE id = ? LIMIT 1;", [$id]);
    $product = $stmt->fetch();

    $stmt = $dba->query("SELECT * FROM pictures WHERE product_id = ?;", [$id]);
    $pictures = $stmt->fetchAll();

    // TODO: 写真のpathを絶対パスに変更
    $params = ['id' => $id, 'product' => $product, 'pictures' => $pictures];
    $this->view("products/index.php", $params);
  }

  /**
   * GET products/[:id]/update
   *
   * @return void
   */
  public function renderUpdate($id)
  {
    echo "ID: ${id}の商品の更新";
    // ログイン確認

    /**
     * 本人確認
     * 
     * 出品者とログインしている人が同一か?
     */

    $this->view("products/update.php");
  }

  /**
   * POST products/[:id]/update
   *
   * @return void
   */
  public function update($id)
  {
    echo "ID: ${id}の商品の出品更新";
    // ログイン確認

    /**
     * 本人確認
     * 
     * 出品者とログインしている人が同一か?
     */

    // データベースに上書きする

    $this->view("products/${id}");
  }
}
