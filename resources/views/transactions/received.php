<?php if ($is_seller) : ?>
  <h1>商品の受け取り待ち</h1>
<?php else : ?>
  <h1>商品の受け取り確認</h1>
  <form action="<?php echo "./${transactions['id']}/received"; ?>" method="post">
    <input type="submit" value="完了">
  </form>
<?php endif; ?>