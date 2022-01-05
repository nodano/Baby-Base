<?php

namespace Http\Controllers;

use Database\DBAccess;
use Http\Controllers\Controller;
use Verot\Upload\Upload;

/**
 * TODO: 画像アップロード部分の修正 --- アップロード用のクラスを作成し、保存先などの情報を保存する
 */
class ListingController extends Controller
{
  /**
   * GET listing
   *
   * @return void
   */
  public function renderListing()
  {
    if (!$this->auth->check()) {
      $this->push("auth/login");
    }
    $this->view("listing/index.php");
  }

  /**
   * GET listing/confirm
   *
   * @return void
   */
  public function confirm()
  {
    if (!$this->auth->check()) {
      $this->push("auth/login");
    }

    // 入力チェック
    $file_count = count($_FILES["picture"]["tmp_name"] ?? []);
    if ($file_count > 5) {
      $this->push("listing?error=picture_count");
    }

    /**
     * class.upload.phpを利用するために新規配列を作成
     */
    $files = array();
    foreach ($_FILES['picture'] as $k => $l) {
      foreach ($l as $i => $v) {
        if (!array_key_exists($i, $files)) {
          $files[$i] = array();
        }
        $files[$i][$k] = $v;
      }
    }

    /**
     * 保存処理
     */
    $upload_dir = "resources/images/tmp/";
    $upload_dir_local = ROOT . "/" . $upload_dir;
    $i = 0;
    $output_files = [];
    foreach ($files as $file) {
      $handle = new Upload($file);
      if ($handle->uploaded) {
        $handle->allowed = [
          'image/*',
        ];

        $file_name = date("Y-m-d-H-i-s") . "-" . $i;

        $handle->image_convert = 'png';
        $handle->file_overwrite = true;
        $handle->file_auto_rename = false;
        $handle->file_src_name_body = $file_name;
        $handle->image_resize = true;
        $handle->image_ratio = true;
        $handle->image_y = 320;
        $handle->image_x = 320;

        // 表示用変数に格納
        $output_files[$i]['name'] = "{$file_name}.png";
        $output_files[$i]['path'] = ROOT_URL . "{$upload_dir}{$file_name}.png";

        $handle->Process($upload_dir_local);
        if (!$handle->processed) {
          $this->push("listing?error=file_process");
        }
        $i++;
      }
    }
    $params = ['files' => $output_files];

    $this->view("listing/confirm.php", $params);
  }

  /**
   * POST listing
   *
   * @return void
   */
  public function listing()
  {
    if (!$this->auth->check()) {
      $this->push("auth/login");
    }

    /**
     * TODO: 入力チェック
     *  - 変更される可能性があるため、全く同じ入力チェックを行う
     */

    $upload_files = []; // メインディレクトリに移動できた画像の配列
    if (isset($_POST['files'])) {
      $upload_dir = "resources/images/tmp/";
      $upload_dir_local = ROOT . "/" . $upload_dir;

      for ($i = 0; $i < count($_POST['files']); $i++) {
        $file_name = $_POST['files'][$i];
        if (file_exists($upload_dir_local . $file_name)) {
          rename($upload_dir_local . $file_name, ROOT . "/" . "resources/images/main/" . $file_name);
          $upload_files[] = $file_name;
        }
      }
    }

    /**
     * 取引をデータベースに登録
     * TODO: ログインユーザーの値をメソッドで取得
     */
    $dba = DBAccess::getInstance();
    $dba->query("INSERT INTO products (name, price, description, user_id) VALUES (?, ?, ?, ?);", [$_POST['name'], $_POST['price'], $_POST['description'], $_SESSION['id']]);
    $productID = $dba->getLastInsertID();

    /**
     * 写真のアップロードに成功していれば、データベースに登録
     */
    if (count($upload_files)) {
      $sql = "INSERT INTO pictures (product_id, path) VALUES ";
      $params = [];
      for ($i = 0; $i < count($upload_files); $i++) {
        if ($i !== 0) $sql .= ", ";
        $sql .= "(?, ?)";
        $params[] = $productID;
        $params[] = $upload_files[$i];
      }
      $dba->query($sql, $params);
    }

    $this->push("products/${productID}");
  }
}
