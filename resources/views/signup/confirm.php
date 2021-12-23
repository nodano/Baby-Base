<?php require_once ROOT . "/resources/views/header.php" ; ?>

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