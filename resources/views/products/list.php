<h1>商品一覧</h1>
<form action="" method="get">
    <select name="sort">
        <option value="">選択してください</option>
        <option value="priceDesc">価格高い順</option>
        <option value="priceAsc">価格安い順</option>
        <option value="idDesc">最新商品</option>
        <option value="idAsc">最古商品</option>
    </select>
    <input type="submit" value="送信">
</form>

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

