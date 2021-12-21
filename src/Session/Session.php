<?php

namespace Session;

class Session {
  public static function start() {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
      session_regenerate_id(true);
    }
  }

  public static function destroy() {
    $_SESSION = array();
    session_destroy();
  }
}