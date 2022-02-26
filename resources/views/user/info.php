<h1>会員情報更新</h1>

<form action="info" method="post" class="form">

  <?php if (isset($_GET['error'])) : ?>
    <p class="form-error"><?php echo Util::h(urldecode($_GET['error'])); ?></p>
  <?php endif; ?>

  <div class="form-item">
    <div class="form-item-label">
      <label for="name">氏名: </label>
    </div>
    <div class="form-item-control">
      <input type="text" name="name" id="name" class="form-item-input" value="<?php echo Util::h($user['name']); ?>" required>
    </div>
    <p class="form-helper-text">※氏名を半角スペースなしで入力してください</p>
  </div>

  <div class="form-item">
    <div class="form-item-label">
      <label for="username">ユーザー名: </label>
    </div>
    <div class="form-item-control">
      <input type="text" name="username" id="username" class="form-item-input" value="<?php echo Util::h($user['username']); ?>" required>
    </div>
    <p class="form-helper-text">※2文字以上8文字以内で入力してください</p>
  </div>

  <div class="form-item">
    <div class="form-item-label">
      <label for="email">メールアドレス: </label>
    </div>
    <div class="form-item-control">
      <input type="email" name="email" id="email" class="form-item-input" value="<?php echo Util::h($user['email']); ?>" required>
    </div>
  </div>

  <div class="form-item">
    <div class="form-item-label">
      <label for="password">パスワード: </label>
    </div>
    <div class="form-item-control">
      <input type="password" name="password" id="password" class="form-item-input" required>
    </div>
    <p class="form-helper-text">※2文字以上8文字以内で入力してください</p>
  </div>

  <div class="form-item">
    <div class="form-item-label">
      <label for="password2">パスワード（再入力）: </label>
    </div>
    <div class="form-item-control">
      <input type="password" name="password2" id="password2" class="form-item-input" required>
    </div>
  </div>

  <div class="form-item">
    <input type="submit" class="button form-submit" value="更新">
  </div>

  <div class="form-item">
    <a href="<?php echo PUBLIC_URL . 'mypage'; ?>" class="button button-secondary">キャンセル</a>
  </div>

</form>