<?php

class Util
{
  /**
   * エスケープ処理
   *
   * @param string $str
   * @return string
   */
  public static function h(string $str): string
  {
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
  }
}
