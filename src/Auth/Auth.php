<?php

namespace Auth;

use Auth\User\LoginUser;
use Session\Session;

class Auth
{
  public function __construct()
  {
    Session::start();
  }

  public function register(array $credentials)
  {
  }

  public function login(LoginUser $user)
  {
    $_SESSION['login'] = true;
    $_SESSION['id'] = $user->getId();
    $_SESSION['username'] = $user->getUsername();
  }

  public function check(): bool
  {
    if (isset($_SESSION['login']) && $_SESSION['login']) {
      return true;
    }
    return false;
  }

  public function getUser()
  {
    if ($this->check()) {
      return new LoginUser($_SESSION['id'], $_SESSION['username']);
    }
    return false;
  }

  public function logout()
  {
    if ($this->check()) {
      unset($_SESSION["login"]);
      unset($_SESSION["id"]);
      unset($_SESSION["username"]);
    }
  }
}
