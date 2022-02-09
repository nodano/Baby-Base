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
      <!-- TODO: 取引画面へのリンクを表示する -->
      <?php if (!$is_seller) : ?>
        <?php if ($product['status'] === 0) : ?>
          <form action='<?php echo "../transactions/${id}"; ?>' method="post">
            <input type="submit" value="購入手続きへ" class="button t-bold">
          </form>
        <?php elseif ($product['status'] === 1) : ?>
          <p>購入した本人なら取引画面へのリンクを表示する</p>
        <?php else : ?>
          <p>他のユーザーが取引済み</p>
        <?php endif; ?>
      <?php endif; ?>
    </div>

    <div class="product-description-container">
      <h2 class="product-headline">商品の説明</h2>
      <p class="product-description"><?php echo $product['description']; ?></p>
    </div>

  </div><!-- .product-body -->
</div>