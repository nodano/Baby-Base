  <h1>ブロック一覧</h1>
  <div class="block">
    <ul>
      <?php foreach ($users as $user) : ?>
        <li class="block-item">
          <a href="<?php echo '../users/' . $user['id'] . '?block=show'; ?>"><?php echo Util::h($user['username']); ?></a>
          <form action="<?php echo '../users/' . $user['id'] . '/block'; ?>" method="post">
            <input type="submit" value="ブロックを解除する" class="button button-secondary">
          </form>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>