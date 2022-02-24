<?php

namespace Http\Controllers;

use Database\DBAccess;
use Http\Controllers\Controller;
use Validate;

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
     * 取引中ではない かつ 出品者 -> 商品情報の更新リンク
     * 
     * 取引中ではない かつ ログインしていない -> ログイン必要ボタン
     * 取引中ではない かつ 出品者 -> 購入者を待っているボタン
     * 取引中ではない かつ 出品者ではない -> 購入手続きボタン
     * 取引中 かつ 購入者または出品者 -> 取引遷移ボタン
     * それ以外ならば 取引中 かつ 購入者または出品者ではない -> 売り切れボタン
     */

    // データベースから商品情報と商品画像を取得
    $dba = DBAccess::getInstance();
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
    if (!$this->auth->check()) {
      $this->push("auth/login");
    }

    $dba = DBAccess::getInstance();
    $stmt = $dba->query("SELECT name, price, description, status, user_id FROM products WHERE id = ? LIMIT 1;", [$id]);
    $product = $stmt->fetch();

    // 出品者本人か確認
    $user = $this->auth->getUser();
    $user_id = $user->getId();
    if ($user_id !== $product['user_id']) {
      $this->push("products/${id}?error=identification");
    }

    // 取引中ではない
    if ($product['status'] !== 0) {
      $this->push("products/${id}?error=already");
    }

    $params = ['id' => $id, 'product' => $product];

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
    if (!$this->auth->check()) {
      $this->push("auth/login");
    }

    $dba = DBAccess::getInstance();
    $stmt = $dba->query("SELECT status, user_id FROM products WHERE id = ? LIMIT 1;", [$id]);
    $product = $stmt->fetch();

    // 出品者本人か確認
    $user = $this->auth->getUser();
    $user_id = $user->getId();
    if ($user_id !== $product['user_id']) {
      $this->push("products/${id}?error=identification");
    }

    // 取引中ではない
    if ($product['status'] !== 0) {
      $this->push("products/${id}?error=already");
    }

    // 商品情報のバリデート
    $validate = new Validate;

    $name         = $validate->escape($_POST['name']);
    $description  = $validate->escape($_POST['description']);
    $price        = $validate->validateTrim($_POST['price']);

    if ($name == false || $description == false || $price == false) {
      $this->push("products/${id}/update?error=blank");
    }

    if ($validate->valideteWordCount($name, 1, 30) == false) {
      $this->push("products/${id}/update?error=name_length");
    }

    if ($validate->valideteWordCount($description, 0, 300) == false) {
      $this->push("products/${id}/update?error=description_length");
    }

    if (is_numeric($price) == false) {
      $this->push("products/${id}/update?error=price_format");
    }

    if ($validate->validateInt($price, 100, 300000) == false) {
      $this->push("products/${id}/update?error=price_value");
    }

    // データベースの上書き
    $dba->query("UPDATE products SET name = ?, description = ?, price = ? WHERE id = ? LIMIT 1;", [$name, $description, $price, $id]);

    $this->push("products/${id}");
  }
}
