<?php

class Validate
{

    /**
     * バリデートの関数
     */

    // 空白文字の削除 / nullチェック
    public function validateTrim($string)
    {
        if (isset($string)) {
            return trim($string);
        } else {
            return false;
        }
    }

    // 文字数のチェック
    public function valideteWordCount($string, $min, $max)
    {
        if (mb_strlen($string) <= $max && mb_strlen($string) >= $min) {
            return true;
        } else {
            return false;
        }
    }

    // 日本語かどうか
    public function validateJP($string)
    {
        $pattern = "/^[ぁ-んァ-ヶ一-龠々]+$/u";
        if (preg_match($pattern, $string)) {
            return true;
        } else {
            return false;
        }
    }

    // 英数字かどうか
    public function validateEng($string)
    {
        $pattern = "/^[a-zA-Z0-9]+$/";
        if (preg_match($pattern, $string)) {
            return True;
        } else {
            return false;
        }
    }

    // メールアドレスかどうか
    public function validateMail($string)
    {
        $pattern = "/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/";
        if (preg_match($pattern, $string)) {
            return True;
        } else {
            return false;
        }
    }

    // パスワードの一致
    public function passCheck($password, $password2)
    {
        if ($password == $password2) {
            return true;
        } else {
            return false;
        }
    }
}
