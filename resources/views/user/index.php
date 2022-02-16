<div class="user-info">
  <h1 class="user-name"><?php echo $user['username']; ?></h1>
  <ul class="user-options">
    <li>
      <a href="<?php echo PUBLIC_URL . "mypage/info"; ?>">ユーザー情報の更新</a>
    </li>
    <li>
      <a href="<?php echo PUBLIC_URL . "mypage/profit"; ?>">売上確認</a>
    </li>
  </ul>
</div>

<section>
  <h2 class="section-title">取引中</h2>
  <div class="card-container">
    <?php foreach ($transaction_products as $product) : ?>
      <div class="card">
        <div class="card-header">
          <a href="<?php echo PUBLIC_URL . 'transactions/' . $product['id']; ?>">
            <img src="<?php echo ROOT_URL . 'resources/images/main/' . $product['path']; ?>" alt="<?php echo $product['name']; ?> サムネイル画像" class="card-image">
          </a>
          <div class="card-price">&yen;<?php echo $product['price']; ?></div>
        </div>
        <div class="card-body"><?php echo $product['name']; ?></div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<section>
  <h2 class="section-title">出品中</h2>
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
</section>

<section>
  <h2 class="section-title">取引済み</h2>
  <div class="card-container">
    <?php foreach ($completed_products as $product) : ?>
      <div class="card">
        <div class="card-header">
          <a href="<?php echo PUBLIC_URL . 'transactions/' . $product['id']; ?>">
            <img src="<?php echo ROOT_URL . 'resources/images/main/' . $product['path']; ?>" alt="<?php echo $product['name']; ?> サムネイル画像" class="card-image">
          </a>
          <div class="card-price">&yen;<?php echo $product['price']; ?></div>
        </div>
        <div class="card-body"><?php echo $product['name']; ?></div>
      </div>
    <?php endforeach; ?>
  </div>
</section>