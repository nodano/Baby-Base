<?php

namespace Database;

use PDO;
use PDOException;
use PDOStatement;

/**
 * データベースアクセスクラス
 */
class DBAccess
{
    private static $instance;
    private ?PDO $pdo = null;
    private int $lastInsertID = 0;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
    }

    public function query(string $sql, array $params = null): PDOStatement
    {
        if (!$this->pdo) {
            $this->connect();
        }

        try {
            $this->beginTransaction();
            $stmt = $this->pdo->prepare($sql);

            if (!is_null($params)) {
                $this->bind($stmt, $params);
            }

            $stmt->execute();
            $this->lastInsertId = $this->pdo->lastInsertId();
            $this->commit();

            return $stmt;
        } catch (PDOException $e) {
            $this->rollBack();
            throw $e;
        }
    }

    public function getLastInsertID()
    {
        return $this->lastInsertId;
    }

    private function connect()
    {
        $config = require_once ROOT . "/config/database.php";

        $dsn = "{$config['driver']}:dbname={$config['dbname']};host={$config['host']};charset={$config['charset']}";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        $this->pdo = new PDO($dsn, $config['username'], $config['password'], $options);
    }

    private function bind(PDOStatement $stmt, array $params)
    {
        $i = 1;
        foreach ($params as $param) {
            $stmt->bindValue($i, $param);
            $i++;
        }
        unset($params);
    }

    private function beginTransaction()
    {
        $this->pdo->beginTransaction();
    }

    private function commit()
    {
        $this->pdo->commit();
    }

    private function rollBack()
    {
        $this->pdo->rollBack();
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}
