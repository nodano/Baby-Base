<?php require_once ROOT . "/resources/views/header.php" ; ?>

  <h1>Signup</h1>

  <form action="signup/confirm" method="POST">
    <input type="text" name="name" id="name" placeholder="氏名">
    <input type="text" name="username" id="username" placeholder="ユーザー名">
    <input type="email" name="email" id="email" placeholder="メールアドレス">
    <input type="password" name="password" id="password">
    <input type="submit" value="確認">
  </form>
</body>

</html>