<h1>会員情報更新</h1>

<form action="info" method="post">
  <input type="text" name="username" id="username" value="<?php echo $user['username']; ?>">
  <input type="text" name="name" id="name" value="<?php echo $user['name']; ?>">
  <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>">
  <input type="submit" value="更新">
</form>