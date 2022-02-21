<div class="hero-image-container">
  <img src="<?php echo ASSETS_URL . 'images/main.jpg'; ?>" alt="Baby-Base メイン画像" class="hero-image">
</div>

<article>
  <section>
    <h2 class="section-title">新着アイテム</h2>
    <div class="card-container">

      <?php
      foreach ($latest_products as $product) :
      ?>
        <div class="card">
          <div class="card-header">
            <a href="<?php echo Util::h(PUBLIC_URL . 'products/' . $product['id']); ?>">
              <img src="<?php echo Util::h(ROOT_URL . 'resources/images/main/' . $product['path']); ?>" alt="<?php echo Util::h($product['name']); ?> サムネイル画像" class="card-image">
            </a>
            <div class="card-price">&yen;<?php echo Util::h(number_format($product['price'])); ?></div>
          </div>
          <div class="card-body"><?php echo Util::h($product['name']); ?></div>
        </div>
      <?php
      endforeach;
      ?>

    </div>

    <a href="<?php echo PUBLIC_URL . "products" ?>" class="button button-rounded">もっと見る</a>
  </section>
  <section>
    <h2 class="section-title">人気アイテム</h2>
    <div class="card-container">

      <?php
      foreach ($popular_products as $product) :
      ?>
        <div class="card">
          <div class="card-header">
            <a href="<?php echo Util::h(PUBLIC_URL . 'products/' . $product['id']); ?>">
              <img src="<?php echo Util::h(ROOT_URL . 'resources/images/main/' . $product['path']); ?>" alt="<?php echo Util::h($product['name']); ?> サムネイル画像" class="card-image">
            </a>
            <div class="card-price">&yen;<?php echo Util::h(number_format($product['price'])); ?></div>
          </div>
          <div class="card-body"><?php echo Util::h($product['name']); ?></div>
        </div>
      <?php
      endforeach;
      ?>

    </div>
    <a href="<?php echo PUBLIC_URL . "products" ?>" class="button button-rounded">もっと見る</a>
  </section>
  <section>
    <h2 class="section-title">おすすめアイテム</h2>
    <div class="card-container">

      <?php
      foreach ($recommend_products as $product) :
      ?>
        <div class="card">
          <div class="card-header">
            <a href="<?php echo Util::h(PUBLIC_URL . 'products/' . $product['id']); ?>">
              <img src="<?php echo Util::h(ROOT_URL . 'resources/images/main/' . $product['path']); ?>" alt="<?php echo Util::h($product['name']); ?> サムネイル画像" class="card-image">
            </a>
            <div class="card-price">&yen;<?php echo Util::h(number_format($product['price'])); ?></div>
          </div>
          <div class="card-body"><?php echo Util::h($product['name']); ?></div>
        </div>
      <?php
      endforeach;
      ?>

    </div>
    <a href="<?php echo PUBLIC_URL . "products" ?>" class="button button-rounded">もっと見る</a>
  </section>
</article>