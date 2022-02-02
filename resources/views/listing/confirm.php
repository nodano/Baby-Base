<?php
/**
 * @param array | null $files 保存したい画像集
 */
$files_count = count($files);
?>

<h1>出品内容の確認</h1>
<form action="../listing" method="POST" class="form">

  <div class="form-item">
    <div class="form-item-label">
      <label for="name">商品名</label>
    </div>
    <div class="form-item-control">
      <input type="text" name="name" id="name" value="<?php echo $_POST['name']; ?>" class="form-item-input" readonly required>
    </div>
  </div>

  <div class="form-item">
    <div class="form-item-label">
      <label for="description">商品説明</label>
    </div>
    <div class="form-item-control">
      <textarea name="description" id="description" class="form-item-input form-item-input-textarea" cols="30" rows="10" readonly required><?php echo $_POST['description']; ?></textarea>
    </div>
  </div>

  <div class="form-item">
    <div class="form-item-label">
      <label for="price">値段</label>
    </div>
    <div class="form-item-control">
      <input type="number" name="price" id="price" class="form-item-input" min="100" max="300000" value="<?php echo $_POST['price']; ?>" readonly required>
    </div>
  </div>

  <?php if ($files_count > 0) : ?>
    <?php for ($i = 0; $i < $files_count; $i++) : ?>
      <input type="hidden" name="files[]" value="<?php echo $files[$i]['name']; ?>">
    <?php endfor; ?>

    <div class="form-item">
      <p>画像</p>
      <div class="l-flex">
        <?php for ($i = 0; $i < $files_count; $i++) : ?>
          <div class="w-5">
            <img src="<?php echo $files[$i]['path']; ?>" alt="出品画像 その<?php echo $i; ?>">
          </div>
        <?php endfor; ?>
      </div>
    </div>
  <?php endif; ?>

  <div class="form-item">
    <input type="submit" value="商品の出品" class="button form-submit">
  </div>
  <div class="form-item">
    <button type="button" class="button button-secondary" onclick="history.back()">キャンセル</button>
  </div>
</form>