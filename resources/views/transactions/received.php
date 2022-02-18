<?php require_once("transaction_header.php"); ?>

<?php if ($is_seller) : ?>
  <div class="alert">
    <p>購入者が商品を受け取っていません</p>
  </div>
<?php else : ?>

  <div class="alert">
    <p>商品を受け取ったら、ボタンを押してください</p>
  </div>

  <form action="<?php echo "./${transactions['id']}/received"; ?>" method="post" class="form">
    <div class="form-item">
      <input type="submit" value="商品を受け取りました" class="button form-submit">
    </div>
  </form>
<?php endif; ?>