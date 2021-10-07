<?php
declare(strict_types=1);

if (!defined('APP_STARTED')) {
    die();
}

$conf = [
  'host' => 'localhost',
  'port' => 3306,
  'db_name' => 'public',
  'username' => 'admin',
  'password' => 'HgKSwDzijI5s'
];

$connection = null;


function getDbConnection(): PDO
{
    global $conf;
    global $connection;
    if ($connection === null) {
        $connection = connectDb($conf['host'], $conf['port'], $conf['db_name'], $conf['username'], $conf['password']);
    }
    return $connection;
}

function connectDb($host, $port, $dbName, $username, $password): PDO
{
    $pdo = new PDO("mysql:host={$host}:{$port};dbname={$dbName}",$username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

function insertUser(array $user)
{
    $pdo = getDbConnection();
    $name = $user['NAME'];
    $surname = $user['SURNAME'];
    $phone = $user['PHONE'];
    $email = $user['EMAIL'];
    $sql = <<<SQL
INSERT INTO `users` 
    (`name`, `surname`, `phone`, `email`) 
VALUES (:name, :surname, :phone, :email) 
SQL;
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam('name', $name);
    $stmt->bindParam('surname', $surname);
    $stmt->bindParam('phone', $phone);
    $stmt->bindParam('email', $email);
    $stmt->execute();
}

