<h1 class="t-center">取引画面</h1>

<div class="transaction">
  <p class="transaction-headline">商品情報</p>
  <div class="transaction-info">
    <h2 class="transaction-name"><a href="<?php echo PUBLIC_URL . "products/" . $product['id']; ?>"><?php echo $product['name']; ?></a></h2>
    <p class="transaction-price"><span>商品代金:</span> &yen; <?php echo number_format($product['price']); ?></p>
    <p class="transaction-date"><span>購入日時:</span> <?php echo $transactions['purchase_date']; ?></p>
  </div>
</div>