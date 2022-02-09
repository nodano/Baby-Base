<?php require_once("transaction_header.php"); ?>

<?php if ($is_seller) : ?>
  <div>

    <div class="alert">
      <p>発送を行ってください</p>
    </div>

    <form action='<?php echo "./${transactions['id']}/send"; ?>' method="post" class="form">
      <input type="submit" value="発送完了" class="button">
    </form>
  </div>
<?php else : ?>
  <div class="alert">
    <p>発送を待っています</p>
  </div>
<?php endif; ?>