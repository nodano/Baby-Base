<?php

namespace Http\Controllers;

use Database\DBAccess;
use Http\Controllers\Controller;

class WelcomController extends Controller
{
  public function get()
  {
    // おすすめ取得(適当に商品一覧を取得する) → ID降順(仮)
    /** 提案
     * ・ユーザ登録時に、興味のあるカテゴリを選択してもらう
     * ・productsの中にカテゴリの欄を作る
     * ・登録された興味のあるカテゴリと一致するproductsをおすすめに表示する
     */
    $dba = DBAccess::getInstance();
    $stmt = $dba->query("SELECT distinct products.id,name,price,status,path FROM products LEFT OUTER JOIN pictures ON products.id = pictures.product_id ORDER BY id DESC LIMIT 5;");
    $products = $stmt->fetchAll();


    /**
     * おすすめ・人気は重複してもOK
     * 先行順 販売されてる順 などなんでもいいから取得する
     * 
     * 商品名 商品の値段 商品の画像(picturesテーブル/ある場合のみ)
     * 
     * $dba = DBAccess::getInstance();
     * $dba->query("INSERT INTO users (username, password, name, email) VALUES(?, ?, ?, ?);", [$_POST['username'], $hashed_password, $_POST['name'], $_POST['email']]);
     */

    // 人気取得(適当に商品一覧を取得する) → ID昇順(仮)
    $dba = DBAccess::getInstance();
    $stmt = $dba->query("SELECT distinct products.id,name,price,status,path FROM products LEFT OUTER JOIN pictures ON products.id = pictures.product_id ORDER BY id ASC LIMIT 5;");
    $products2 = $stmt->fetchAll();

    // 他(適当に商品一覧を取得する)
    $dba = DBAccess::getInstance();
    $stmt = $dba->query("SELECT distinct products.id,name,price,status,path FROM products LEFT OUTER JOIN pictures ON products.id = pictures.product_id ORDER BY rand() ASC LIMIT 5;");
    $products3 = $stmt->fetchAll();



    $params = ["products" => $products, 'products2' => $products2, 'products3' => $products3];

    $this->view("index.php", $params);
  }
}
