<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>サインアップ</title>
</head>

<body>
  <h1>サインアップ</h1>
  <form action="../signup" method="post">
    <input type="hidden" name="name" id="name" value="<?php echo $_POST['name']; ?>">
    <input type="hidden" name="username" id="username" value="<?php echo $_POST['username']; ?>">
    <input type="hidden" name="email" id="email" value="<?php echo $_POST['email']; ?>">
    <input type="hidden" name="password" id="password" value="<?php echo $_POST['password']; ?>">
    <input type="submit" value="サインアップ">
  </form>
</body>

</html>