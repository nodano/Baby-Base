<h1>出品情報更新</h1>
<form action="" method="post" class="form">

  <div class="form-item">
    <div class="form-item-label">
      <label for="name">商品名: </label>
    </div>
    <div class="form-item-control">
      <input type="text" name="name" id="name" class="form-item-input" required>
    </div>
  </div>

  <div class="form-item">
    <div class="form-item-label">
      <label for="description">商品説明: </label>
    </div>
    <div class="form-item-control">
      <textarea name="description" id="description" cols="30" rows="10" class="form-item-input form-item-input-textarea" required></textarea>
    </div>
  </div>

  <div class="form-item">
    <div class="form-item-label">
      <label for="price">値段: </label>
    </div>
    <div class="form-item-control">
      <input type="number" name="price" id="price" min="100" max="300000" class="form-item-input" required>
    </div>
  </div>

  <div class="form-item">
    <input type="submit" value="出品内容の更新" class="button form-submit">
  </div>

  <div class="form-item">
    <a href="<?php echo PUBLIC_URL . "products/${id}"; ?>" class="button button-secondary">キャンセル</a>
  </div>

</form>