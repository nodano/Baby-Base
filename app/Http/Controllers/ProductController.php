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
    /**
     * 検索した商品を表示する画面
     * $products → fetchAll()
     */
    // もしURLパラメータがあれば、取得と検証
    if (isset($_GET['search'])) {
      $search = $_GET['search'];
    } else {
      $search = "";
    }

    // データベースから、商品の一覧を取得する
    $dba = DBAccess::getInstance();

    if (isset($_GET['sort'])) {
      switch ($_GET['sort']) {
        case "priceDesc":
          //高い→安い
          $stmt = $dba->query("SELECT distinct products.id,name,price,status,path FROM products LEFT OUTER JOIN pictures ON products.id = pictures.product_id WHERE name LIKE ? || description LIKE ? ORDER BY price DESC LIMIT 30;", ["%$search%", "%$search%"]);
          break;

        case "priceAsc":
          //安い→高い
          $stmt = $dba->query("SELECT distinct products.id,name,price,status,path FROM products LEFT OUTER JOIN pictures ON products.id = pictures.product_id WHERE name LIKE ? || description LIKE ? ORDER BY price ASC LIMIT 30;", ["%$search%", "%$search%"]);
          break;

        case "idDesc":
          //ID高い→低い(新着順)
          $stmt = $dba->query("SELECT distinct products.id,name,price,status,path FROM products LEFT OUTER JOIN pictures ON products.id = pictures.product_id WHERE name LIKE ? || description LIKE ? ORDER BY products.id DESC LIMIT 30;", ["%$search%", "%$search%"]);
          break;

        case "idAsc":
          //ID低い→高い(古い順)
          $stmt = $dba->query("SELECT distinct products.id,name,price,status,path FROM products LEFT OUTER JOIN pictures ON products.id = pictures.product_id WHERE name LIKE ? || description LIKE ? ORDER BY products.id ASC LIMIT 30;", ["%$search%", "%$search%"]);
          break;

        default:
          $stmt = $dba->query("SELECT distinct products.id,name,price,status,path FROM products LEFT OUTER JOIN pictures ON products.id = pictures.product_id WHERE name LIKE ? || description LIKE ? LIMIT 30;", ["%$search%", "%$search%"]);
          break;
      }
    } else {
      $stmt = $dba->query("SELECT distinct products.id,name,price,status,path FROM products LEFT OUTER JOIN pictures ON products.id = pictures.product_id WHERE name LIKE ? || description LIKE ? LIMIT 30;", ["%$search%", "%$search%"]);
    }


    $products = $stmt->fetchAll();

    $params = ['products' => $products];
    $this->view("products/list.php", $params);
  }

  /**
   * GET products/[:id]
   *
   * @param [int] $id
   * @return void
   */
  public function fetchByID($id)
  {
    /**
     * 取引中ではない かつ ログインしていない -> ログインボタン
     * 取引中ではない かつ 売り手ではない -> 購入ボタン
     * 売り手　もしくは　買い手 -> 取引先ボタン
     * それいがい
     */

    // データベースから商品情報と商品画像を取得
    $dba = DBAccess::getInstance();
    // $stmt = $dba->query("SELECT * FROM products WHERE id = ? LIMIT 1;", [$id]);
    $stmt = $dba->query("SELECT p.name, p.price, p.description, p.user_id AS seller_id, t.user_id AS buyer_id, t.id AS transaction_id, username FROM products AS p LEFT OUTER JOIN transactions AS t ON p.id = t.product_id LEFT OUTER JOIN users AS u ON u.id = p.user_id WHERE p.id = ? LIMIT 1;", [$id]);
    $product = $stmt->fetch();

    $stmt = $dba->query("SELECT * FROM pictures WHERE product_id = ?;", [$id]);
    $pictures = $stmt->fetchAll();

    if ($this->auth->check()) {
      $user = $this->auth->getUser();
      $user_id = $user->getId();
    } else {
      $user_id = -100;
    }

    $params = ['id' => $id, 'product' => $product, 'pictures' => $pictures, 'user_id' => $user_id];
    $this->view("products/index.php", $params);
  }

  /**
   * GET products/[:id]/update
   *
   * @return void
   */
  public function renderUpdate($id)
  {
    // ログイン確認

    /**
     * 本人確認
     * 
     * 出品者とログインしている人が同一か?
     */

    // 取引中ではない
    $params = ['id' => $id];

    $this->view("products/update.php", $params);
  }

  /**
   * POST products/[:id]/update
   *
   * @return void
   */
  public function update($id)
  {
    // ログイン確認

    /**
     * 本人確認
     * 
     * 出品者とログインしている人が同一か?
     */

    // 取引中ではない

    // データベースに上書きする

    $this->push("products/${id}");
  }
}
