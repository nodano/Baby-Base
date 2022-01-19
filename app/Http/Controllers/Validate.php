<?

class Validate
{

    /**
     * バリデートの関数
     */

    // 空白文字の削除
    public function validateTrim()
    {

        if (isset($_POST['name'])) {
            $name = trim($_POST['name']);
        } else {
            $name = "";
        }

        if (isset($_POST['username'])) {
            $username = trim($_POST['username']);
        } else {
            $username = "";
        }

        if (isset($_POST['email'])) {
            $email = trim($_POST['email']);
        } else {
            $email = "";
        }

        if (isset($_POST['password'])) {
            $password = trim($_POST['password']);
        } else {
            $password = "";
        }

        if (isset($_POST['password'])) {
            $password2 = trim($_POST['password2']);
        } else {
            $password2 = "";
        }

        $array_Post = array($name, $username, $email, $password, $password2);

        return $array_Post;
    }

    // 文字数のチェック
    public function valideteWordCount($Word, $countMin, $countMax)
    {
        if (mb_strlen($Word) < $countMax + 1 && mb_strlen($Word) > $countMin - 1) {
            return true;
        } else {
            return false;
        }
    }

    // 日本語かどうか
    public function validateJP($Word)
    {
        $validate_JP = "/^[ぁ-んァ-ヶ一-龠々]+$/u";
        if (preg_match($validate_JP, $Word)) {
            return true;
        } else {
            return false;
        }
    }

    // 英数字かどうか
    public function validateEng($Word)
    {
        $validate_Eng = "/^[a-zA-Z0-9]+$/";
        if (preg_match($validate_Eng, $Word)) {
            return True;
        } else {
            return false;
        }
    }

    // メールアドレスかどうか
    public function validateMail($Word)
    {
        $validate_Mail = "/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/";
        if (preg_match($validate_Mail, $Word)) {
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
