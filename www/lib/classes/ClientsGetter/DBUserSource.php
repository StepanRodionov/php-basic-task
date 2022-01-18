<?php
declare(strict_types=1);

require_once 'LocalUserSource.php';

class DBUserSource extends LocalUserSource
{
    static protected array $config = [
        'host' => 'localhost',
        'port' => 3306,
        'db_name' => 'public',
        'username' => 'admin',
        'password' => 'ad9NSgzgioyf'
    ];

    protected function doConnect()
    {
        throw new Exception('cannot use db');
        $host = self::$config['host'];
        $port = self::$config['port'];
        $dbName = self::$config['db_name'];
        $username = self::$config['username'];
        $password = self::$config['password'];

        $pdo = new PDO("mysql:host={$host}:{$port};dbname={$dbName}",$username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    protected function getData(): array
    {
        $result = $this->connection->query('SELECT * FROM public.users');

        /**
         * PDO::FETCH_ASSOC превратит в ассоциативный массив, где ключ - название поля, значение - значение
         */
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}