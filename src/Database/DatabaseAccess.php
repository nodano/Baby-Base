<?php

/**
 * データベースアクセスクラス
 */

class DatabaseAccess
{
    //プロパティ
    private $dsn = '';  //接続文字列
    private $user = ''; //データベースユーザ名
    private $pass = '';  //データベースパスワード
    private $conn = ''; //PDOオブジェクトを格納するプロパティ

    public function __construct()
    {
        $this->dsn = 'mysql:dbname=ph24;host=localhost;charset=utf8';
        $this->user = 'root';
        $this->pass = '';

        $this->conn = new PDO($this->dsn, $this->user, $this->pass);

        return $this->conn;
    }

    public function select($sql1, $sql2, $sql3)
    {

        $sql = "select $sql1 from $sql2 $sql3;";

        $csql = htmlspecialchars($sql, ENT_QUOTES, "UTF-8");

        print($csql);

        $sth = $this->conn->query($csql);
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function insert($sql1, $sql2, $sql3)
    {

        $sql = "insert into $sql1 ($sql2) values ($sql3);";

        $csql = htmlspecialchars($sql, ENT_COMPAT, "UTF-8");

        print($csql);

        $this->conn->query($csql);
    }

    public function update($sql1, $sql2, $sql3)
    {
        $sql = "update $sql1 set $sql2 where $sql3";

        $csql = htmlspecialchars($sql, ENT_COMPAT, "UTF-8");

        $this->conn->query($csql);
    }

    public function delete($sql1, $sql2)
    {
        $sql = "delete from $sql1 where $sql2";

        $csql = htmlspecialchars($sql, ENT_COMPAT, "UTF-8");

        $this->conn->query($csql);
    }
}
