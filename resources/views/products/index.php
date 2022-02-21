<div class="product">
  <div class="product-image-wrap">
    <div class="product-image-main-container">
      <img src="<?php echo ROOT_URL . "/resources/images/main/" . $pictures[0]['path'] ?>" alt="<?php echo $product['name'] ?>の商品画像" class="product-image-main">
    </div>
  </div>

  <div class="product-body">
    <h1 class="product-name"><?php echo $product['name']; ?></h1>
    <p class="product-price"><span>&yen;<?php echo number_format($product['price']); ?></span> (税込) 送料込み</p>
    <div class="product-option">
      <?php if (!isset($product['transaction_id']) && $product['seller_id'] === $user_id) : ?>
        <a href="<?php echo "${id}/update"; ?>">商品情報の更新</a>
      <?php endif; ?>
    </div>

    <div class="product-transaction">
      <?php if (!isset($product['transaction_id']) && !$auth['is_login']) : ?>
        <a href="<?php echo PUBLIC_URL . "auth/login"; ?>" class="button">購入にはログインが必要です</a>
      <?php elseif (!isset($product['transaction_id']) && $product['seller_id'] === $user_id) : ?>
        <button class="button button-disable">まだ購入されていません</button>
      <?php elseif (!isset($product['transaction_id']) && $product['seller_id'] !== $user_id) : ?>
        <form action='<?php echo "../transactions/${id}"; ?>' method="post">
          <input type="submit" value="購入手続きへ" class="button t-bold">
        </form>
      <?php elseif (isset($product['transaction_id']) && ($product['seller_id'] === $user_id || $product['buyer_id'] === $user_id)) : ?>
        <a href="<?php echo "../transactions/" . $product['transaction_id']; ?>" class="button">取引へ進む</a>
      <?php else : ?>
        <button class="button button-disable">売り切れました</button>
      <?php endif; ?>
    </div>

    <div class="product-description-container">
      <h2 class="product-headline">出品者</h2>
      <p><?php echo $product['username']; ?></p>
      <h2 class="product-headline">商品の説明</h2>
      <p class="product-description"><?php echo nl2br($product['description']); ?></p>
    </div>

  </div><!-- .product-body -->
</div>