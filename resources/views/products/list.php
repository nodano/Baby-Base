<h1>商品一覧</h1>
<form action="" method="get" class="form form-search" style="margin-bottom: 1.9rem;">
  <div class="form-item">
    <div class="form-search-container">
      <input type="text" name="search" class="form-item-input" value="<?php if (isset($_GET['search'])) echo Util::h($_GET['search']); ?>" placeholder="検索" maxlength="400">
      <button type="submit"><i class="fas fa-search"></i></button>
    </div>
    <select name="sort" class="form-item-input">
      <option value="idAsc">古い順</option>
      <option value="idDesc">新しい順</option>
      <option value="priceAsc">価格の安い順</option>
      <option value="priceDesc">価格の高い順</option>
    </select>
  </div>
</form>

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