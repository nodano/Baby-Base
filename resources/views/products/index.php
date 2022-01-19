<?php require_once ROOT . "/resources/views/header.php"; ?>

<h1>商品詳細</h1>

<div>
  <h2>商品名: <?php echo $product['name']; ?></h2>
  <p>値段: <?php echo $product['price']; ?></p>
  <p>商品説明: <?php echo $product['description']; ?></p>
  <p>商品状態: <?php echo $product['status']; ?></p>

  <div>
    <?php foreach ($pictures as $picture) : ?>
      <div>
        <img src="<?php echo ROOT_URL . "/resources/images/main/" . $picture['path']; ?>" alt="商品画像">
      </div>
    <?php endforeach; ?>
  </div>

  <?php if (!$is_seller) : ?>
    <div>
      <?php if ($product['status'] === 0) : ?>
        <form action='<?php echo "../transactions/${id}"; ?>' method="post">
          <input type="submit" value="取引">
        </form>
      <?php elseif ($product['status'] === 1) : ?>
        <p>他のユーザーが取引済み</p>
      <?php else : ?>
        <p>取引済み</p>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</div>
</body>

</html>