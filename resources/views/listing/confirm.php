<?php

use Validate;

/**
 * 商品情報のバリデート
 */

$validate = new Validate;

$name         = $validate->escape($_POST['name']);
$description  = $validate->escape($_POST['description']);
$price        = $validate->validateTrim($_POST['price']);

if ($name == false || $description == false || $price == false) {
  $this->push("listing");
}

if ($Validate->valideteWordCount($name, 1, 30) == false) {
  $this->push("listing");
}

if ($Validate->valideteWordCount($description, 0, 300) == false) {
  $this->push("listing");
}

if (is_numeric($price) == false) {
  $this->push("listing");
}

if ($validate->validateInt($price, 100, 300000) == false) {
  $this->push("listing");
}

/**
 * @param array | null $files 保存したい画像集
 */
$files_count = count($files);
?>
<?php require_once ROOT . "/resources/views/header.php"; ?>

<h1>出品確認</h1>
<form action="../listing" method="POST">
  <div>
    <label for="name">商品名</label>
    <input type="text" name="name" id="name" readonly value="<?php echo $name; ?>">
  </div>
  <div>
    <label for="description">商品説明</label>
    <textarea name="description" id="description" cols="30" rows="10" readonly><?php echo $description; ?></textarea>
  </div>
  <div>
    <label for="price">値段</label>
    <input type="number" name="price" id="price" min="100" max="300000" readonly value="<?php echo $price; ?>">
  </div>

  <?php if ($files_count > 0) : ?>
    <?php for ($i = 0; $i < $files_count; $i++) : ?>
      <input type="hidden" name="files[]" value="<?php echo $files[$i]['name']; ?>">
    <?php endfor; ?>

    <div>
      <p>画像</p>
      <ul>
        <?php for ($i = 0; $i < $files_count; $i++) : ?>
          <li>
            <img src="<?php echo $files[$i]['path']; ?>" alt="出品画像 その<?php echo $i; ?>">
          </li>
        <?php endfor; ?>
      </ul>
    </div>
  <?php endif; ?>
  <input type="submit" value="出品">
</form>
</body>

</html>