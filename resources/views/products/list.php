<h1>商品一覧</h1>
<form action="" method="get">
  <input type="text" name="search">
  <input type="submit" value="検索">
  <select name="sort">
    <option value="idAsc">古い順</option>
    <option value="idDesc">新しい順</option>
    <option value="priceAsc">価格の安い順</option>
    <option value="priceDesc">価格の高い順</option>
  </select>
</form>

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