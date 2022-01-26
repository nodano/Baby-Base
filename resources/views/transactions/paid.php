<?php if ($is_seller) : ?>
  <div>
    <h1>商品の発送を行ってください。</h1>
    <form action='<?php echo "./${transactions['id']}/send"; ?>' method="post">
      <input type="submit" value="発送完了">
    </form>
  </div>
<?php else : ?>
  <h1>出品者の発送待ち中です。</h1>
<?php endif; ?>