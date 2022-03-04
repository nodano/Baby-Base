  <h1>ブロック一覧</h1>
  <?php
  for ($i = 0; $i < $blockCount; $i++) : ?>
    <div class="product-block">
      <p><?php print($blockList[$i]['username']); ?></p>
      <form action="<?php echo  "block/" . $blockList[$i]['id']; ?>" method="POST">
        <input type="submit" class="button" value="ブロックを解除">
      </form>
    </div>
  <?php endfor; ?>