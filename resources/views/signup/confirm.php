<h1>会員登録 入力内容の確認</h1>
<form action="../signup" method="post" class="form">
  <input type="hidden" name="password" value="<?php echo $_POST['password']; ?>">

  <div class="form-item">
    <div class="form-item-label">
      <label for="name">氏名: </label>
    </div>
    <div class="form-item-control">
      <input type="text" name="name" id="name" value="<?php echo $_POST['name']; ?>" class="form-item-input" readonly required>
    </div>
  </div>

  <div class="form-item">
    <div class="form-item-label">
      <label for="username">ユーザー名: </label>
    </div>
    <div class="form-item-control">
      <input type="text" name="username" id="username" value="<?php echo $_POST['username']; ?>" class="form-item-input" readonly required>
    </div>
  </div>

  <div class="form-item">
    <div class="form-item-label">
      <label for="email">メールアドレス: </label>
    </div>
    <div class="form-item-control">
      <input type="email" name="email" id="email" value="<?php echo $_POST['email']; ?>" class="form-item-input" readonly required>
    </div>
  </div>

  <div class="form-item">
    <input type="submit" value="サインアップ" class="button form-submit">
  </div>
  <div class="form-item">
    <button type="button" class="button button-secondary" onclick="history.back()">キャンセル</button>
  </div>

</form>