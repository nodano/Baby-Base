  <h1>ログイン</h1>

  <form action="" method="POST" class="form">

    <div class="form-item">
      <div class="form-item-label">
        <label for="login">ユーザー名またはメールアドレス: </label>
      </div>
      <div class="form-item-control">
        <input type="text" name="login" id="login" class="form-item-input" required>
      </div>
    </div>

    <div class="form-item">
      <div class="form-item-label">
        <label for="password">パスワード: </label>
      </div>
      <div class="form-item-control">
        <input type="password" name="password" id="password" class="form-item-input" required>
      </div>
    </div>

    <div class="form-item">
      <input type="submit" value="ログイン" class="button form-submit">
    </div>

    <div class="form-item">
      <a href="<?php echo PUBLIC_URL . 'auth/signup'; ?>" class="button button-secondary">会員登録がお済でない方はこちらから</a>
    </div>

  </form>