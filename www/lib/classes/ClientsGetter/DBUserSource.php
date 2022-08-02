<?php
declare(strict_types=1);

namespace App\ClientsGetter;

class DBUserSource extends LocalUserSource
{
    static protected array $config = [
        'host' => 'localhost',
        'port' => 3306,
        'db_name' => 'public',
        'username' => 'admin',
        'password' => 'mAaSuHka7u5D'
    ];

    protected function doConnect()
    {
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