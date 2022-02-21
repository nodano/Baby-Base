<h1>出品</h1>
<form action="listing/confirm" method="post" enctype="multipart/form-data" class="form">

  <?php if (isset($_GET['error'])) : ?>
    <p class="form-error"><?php echo Util::h($_GET['error']); ?></p>
  <?php endif; ?>

  <div class="form-item">
    <div class="form-item-label">
      <label for="name">商品名: </label>
    </div>
    <div class="form-item-control">
      <input type="text" name="name" id="name" class="form-item-input" required>
    </div>
    <p class="form-helper-text">※30文字以内で入力してください</p>
  </div>

  <div class="form-item">
    <div class="form-item-label">
      <label for="description">商品説明: </label>
    </div>
    <div class="form-item-control">
      <textarea name="description" id="description" cols="30" rows="10" class="form-item-input form-item-input-textarea" required></textarea>
    </div>
    <p class="form-helper-text">※300文字以内で入力してください</p>
  </div>

  <div class="form-item">
    <div class="form-item-label">
      <label for="price">値段: </label>
    </div>
    <div class="form-item-control">
      <input type="number" name="price" id="price" min="100" max="300000" class="form-item-input" required>
    </div>
    <p class="form-helper-text">※100円以上300,000円以内で入力してください</p>
  </div>

  <div class="form-item">
    <div class="form-item-label">
      <label for="picture">商品画像（最大5枚）: </label>
    </div>
    <div class="form-item-control">
      <input type="file" name="picture[]" id="picture" class="form-item-input form-item-input-file" multiple required>
      <label for="picture" class="button button-secondary button-file">画像を選択</label>
    </div>
    <p class="form-helper-text">※後から画像を変更することはできません</p>
  </div>

  <div class="form-item">
    <input type="submit" value="出品内容の確認" class="button form-submit">
  </div>

</form>