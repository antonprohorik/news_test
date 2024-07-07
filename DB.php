<?php

class DB
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $host = 'localhost';
        $dbname = 'workspace__test';
        $username = 'root';
        $password = 'root';
        $port = 3306;

        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exp) {
            echo "Error: {$exp->getMessage()}";
            exit;
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DB();
        }

        return self::$instance;
    }

    public static function conn()
    {
        return self::getInstance()->getConnection();
    }

    private function getConnection()
    {
        return $this->connection;
    }
}