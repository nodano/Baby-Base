<h1>売上確認</h1>
<div class="profit">
  <ul>
    <?php foreach ($transfers as $transfer) : ?>
      <li class="profit-item">
        <span><?php echo Util::h($transfer['name']); ?></span>
        <span><?php echo Util::h(number_format($transfer['amount'])); ?></span>
      </li>
    <?php endforeach; ?>

    <li class="profit-item profit-total"><span>合計: </span><span><?php echo Util::h(number_format($total)); ?></span></li>
  </ul>
</div>