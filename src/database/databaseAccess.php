<?php

/**
 * データベースアクセスクラス
 */

class detabaseAccess
{

    //プロパティ
    private $dsn = '';  //接続先
    private $user = ''; //ユーザ名
    private $pass = ''; //データベースパスワード

    private function __construct()
    {
        $dsn = 'mysql:dbname=ph24;host=localhost;charset=utf8';
        $user = 'root';
        $pass = '';

        $dba = new PDO($dsn, $user, $pass);

        return $dba;
    }

    public function select($sql, $dba)
    {

        $csql = "select " + htmlspecialchars($sql, ENT_QUOTES, "UTF-8");

        $stmt = $dba->prepare($csql);

        $res = $stmt->execute();

        return $res;
    }

    public function insert($sql, $dba)
    {

        $csql = "insert " + htmlspecialchars($sql, ENT_QUOTES, "UTF-8");

        $stmt = $dba->prepare($csql);

        $res = $stmt->execute();

        return $res;
    }

    public function update($sql, $dba)
    {

        $csql = "update " + htmlspecialchars($sql, ENT_QUOTES, "UTF-8");

        $stmt = $dba->prepare($csql);

        $res = $stmt->execute();

        return $res;
    }
    public function delete($sql, $dba)
    {

        $csql = "delete " + htmlspecialchars($sql, ENT_QUOTES, "UTF-8");

        $stmt = $dba->prepare($csql);

        $res = $stmt->execute();

        return $res;
    }
}
