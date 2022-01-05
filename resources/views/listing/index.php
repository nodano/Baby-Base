<?php require_once ROOT . "/resources/views/header.php"; ?>

<h1>出品</h1>
<form action="listing/confirm" method="post" enctype="multipart/form-data">
  <div>
    <label for="name">商品名</label>
    <input type="text" name="name" id="name">
  </div>
  <div>
    <label for="description">商品説明</label>
    <textarea name="description" id="description" cols="30" rows="10"></textarea>
  </div>
  <div>
    <label for="price">値段</label>
    <input type="number" name="price" id="price" min="100" max="300000">
  </div>
  <div>
    <label for="picture">商品画像</label>
    <input type="file" name="picture[]" id="picture" multiple>
  </div>
  <div>
    <input type="submit" value="確認">
  </div>
</form>
</body>

</html>