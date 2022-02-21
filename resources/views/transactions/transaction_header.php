<h1 class="t-center">取引画面</h1>

<div class="transaction">
  <p class="transaction-headline">商品情報</p>
  <div class="transaction-info">
    <h2 class="transaction-name"><a href="<?php echo Util::h(PUBLIC_URL . "products/" . $product['id']); ?>"><?php echo Util::h($product['name']); ?></a></h2>
    <p class="transaction-price"><span>商品代金:</span> &yen; <?php echo Util::h(number_format($product['price'])); ?></p>
    <p class="transaction-date"><span>購入日時:</span> <?php echo Util::h($transactions['purchase_date']); ?></p>
  </div>
</div>