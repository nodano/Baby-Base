<?php

namespace Http\Controllers;

use Database\DBAccess;
use Http\Controllers\Controller;

class WelcomController extends Controller
{
  public function get()
  {
    // おすすめ取得(適当に商品一覧を取得する) → ID降順(仮)
    $dba = DBAccess::getInstance();
    $stmt = $dba->query("SELECT products.id,name,price,status,path, 
      CASE 
        WHEN path LIKE '%0.png' THEN 'TOP'
        ELSE 'NO' 
        END 
      FROM products INNER JOIN pictures ON products.id = pictures.product_id WHERE 
      (CASE WHEN path LIKE '%0.png' THEN 'TOP' ELSE 'NO' END)
       = 'TOP' 
      ORDER BY id DESC LIMIT 5;");
    $latest_products = $stmt->fetchAll();

    // 人気取得(適当に商品一覧を取得する) → ID昇順(仮)
    $dba = DBAccess::getInstance();
    $stmt = $dba->query("SELECT products.id,name,price,status,path, 
    CASE 
      WHEN path LIKE '%0.png' THEN 'TOP'
      ELSE 'NO' 
      END 
    FROM products INNER JOIN pictures ON products.id = pictures.product_id WHERE 
    (CASE WHEN path LIKE '%0.png' THEN 'TOP' ELSE 'NO' END)
     = 'TOP' 
    ORDER BY id ASC LIMIT 5;");
    $popular_products = $stmt->fetchAll();

    // 他(適当に商品一覧を取得する)
    $dba = DBAccess::getInstance();
    $stmt = $dba->query("SELECT products.id,name,price,status,path, 
    CASE 
      WHEN path LIKE '%0.png' THEN 'TOP'
      ELSE 'NO' 
      END 
    FROM products INNER JOIN pictures ON products.id = pictures.product_id WHERE 
    (CASE WHEN path LIKE '%0.png' THEN 'TOP' ELSE 'NO' END)
     = 'TOP' 
    ORDER BY rand() ASC LIMIT 5;");
    $recommend_products = $stmt->fetchAll();



    $params = ["latest_products" => $latest_products, 'popular_products' => $popular_products, 'recommend_products' => $recommend_products];

    $this->view("index.php", $params);
  }
}
