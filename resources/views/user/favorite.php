  <h1>お気に入り商品</h1>

  <div class="card-container">
    <?php foreach ($products as $product) : ?>
      <div class="card">
        <div class="card-header">
          <a href="<?php echo Util::h(PUBLIC_URL . 'products/' . $product['id']); ?>">
            <img src="<?php echo Util::h(ROOT_URL . 'resources/images/main/' . $product['path']); ?>" alt="<?php echo Util::h($product['name']); ?> サムネイル画像" class="card-image">
          </a>
          <div class="card-price">&yen;<?php echo Util::h(number_format($product['price'])); ?></div>
        </div>
        <div class="card-body"><?php echo Util::h($product['name']); ?></div>
      </div>
    <?php endforeach; ?>
  </div>