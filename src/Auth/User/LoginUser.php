<?php

namespace Auth\User;

class LoginUser
{
  private int $id;
  private string $username;

  public function __construct(int $id, string $username)
  {
    $this->id = $id;
    $this->username = $username;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getUsername()
  {
    return $this->username;
  }
}
