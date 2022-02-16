<h1>商品一覧</h1>
<div class="card-container">
  <?php foreach ($products as $product) : ?>
    <div class="card">
      <div class="card-header">
        <a href="<?php echo PUBLIC_URL . 'products/' . $product['id']; ?>">
          <img src="<?php echo ROOT_URL . 'resources/images/main/' . $product['path']; ?>" alt="<?php echo $product['name']; ?> サムネイル画像" class="card-image">
        </a>
        <div class="card-price">&yen;<?php echo $product['price']; ?></div>
      </div>
      <div class="card-body"><?php echo $product['name']; ?></div>
    </div>
  <?php endforeach; ?>
</div>