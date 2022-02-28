<div class="user-info">
  <h1 class="user-name"><?php echo Util::h($user['username']); ?></h1>
  <ul class="user-options">
  </ul>
</div>


<h2>出品した商品</h2>
<div class="card-container">
  <?php foreach ($products as $product) : ?>
    <div class="card">
      <div class="card-header">
        <a href="<?php echo Util::h(PUBLIC_URL . 'products/' . $product['id']); ?>">
          <?php if ($product['status'] === 1) : ?>
            <div class="ribbon ribbon-top-right"><span>SOLD</span></div>
          <?php endif; ?>
          <img src="<?php echo Util::h(ROOT_URL . 'resources/images/main/' . $product['path']); ?>" alt="<?php echo Util::h($product['name']); ?> サムネイル画像" class="card-image">
        </a>
        <div class="card-price">&yen;<?php echo Util::h(number_format($product['price'])); ?></div>
      </div>
      <div class="card-body"><?php echo Util::h($product['name']); ?></div>
    </div>
  <?php endforeach; ?>
</div>