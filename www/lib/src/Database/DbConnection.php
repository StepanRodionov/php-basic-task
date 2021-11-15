<?php

declare(strict_types=1);

namespace Otus\Demoapp\Database;

class DbConnection
{
    private static $instance = null;

    protected $connection;

    protected function __construct($host, $port, $dbName, $username, $password)
    {
        $this->connection = new \PDO("mysql:host={$host}:{$port};dbname={$dbName}",$username, $password);
    }

    protected function __clone(): void
    {
    }

    public static function getInstance($host, $port, $dbName, $username, $password): DbConnection
    {
        if (!self::$instance) {
            self::$instance = new DbConnection($host, $port, $dbName, $username, $password);
        }

        return self::$instance;
    }

    public function getConnection(): \PDO
    {
        return $this->connection;
    }
}