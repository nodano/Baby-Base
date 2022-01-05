<?php

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
    <input type="text" name="name" id="name" readonly value="<?php echo $_POST['name']; ?>">
  </div>
  <div>
    <label for="description">商品説明</label>
    <textarea name="description" id="description" cols="30" rows="10" readonly><?php echo $_POST['description']; ?></textarea>
  </div>
  <div>
    <label for="price">値段</label>
    <input type="number" name="price" id="price" min="100" max="300000" readonly value="<?php echo $_POST['price']; ?>">
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