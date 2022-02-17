<?php var_dump($product); ?>

<div class="product">
  <div class="product-image-wrap">
    <div class="product-image-main-container">
      <img src="<?php echo ROOT_URL . "/resources/images/main/" . $pictures[0]['path'] ?>" alt="<?php echo $product['name'] ?>の商品画像" class="product-image-main">
    </div>
  </div>

  <div class="product-body">
    <h1 class="product-name"><?php echo $product['name']; ?></h1>
    <p class="product-price"><span>&yen;<?php echo number_format($product['price']); ?></span> (税込)</p>
    <div class="product-option">オプション</div>

    <div class="product-transaction">
      <?php if (!isset($product['transaction_id']) && !$auth['is_login']) : ?>
        <a href="<?php echo PUBLIC_URL . "auth/login"; ?>" class="button">購入にはログインが必要です</a>
      <?php elseif (!isset($product['transaction_id']) && $product['seller_id'] !== $user_id) : ?>
        <form action='<?php echo "../transactions/${id}"; ?>' method="post">
          <input type="submit" value="購入手続きへ" class="button t-bold">
        </form>
      <?php elseif ($product['seller_id'] === $user_id || $product['buyer_id'] === $user_id) : ?>
        <a href="<?php echo "../transactions/" . $product['transaction_id']; ?>" class="button">取引画面へ</a>
      <?php endif; ?>
    </div>

    <div class="product-description-container">
      <h2 class="product-headline">商品の説明</h2>
      <p class="product-description"><?php echo $product['description']; ?></p>
    </div>

  </div><!-- .product-body -->
</div>