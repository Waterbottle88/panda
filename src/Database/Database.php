<?php

namespace App\Database;

class Database
{
    private static $instance;
    private $connection;

    private function __construct()
    {
        $config = include(__DIR__ . '/../config.php');
        $databaseConfig = $config['database'];

        $dsn = "mysql:host={$databaseConfig['host']};dbname={$databaseConfig['dbname']};charset=utf8mb4";
        try {
            $this->connection = new \PDO($dsn, $databaseConfig['username'], $databaseConfig['password']);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        } catch (\PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
