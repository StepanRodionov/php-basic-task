<?php
declare(strict_types=1);

use Otus\Demoapp\Database\DbConnection;

if (!defined('APP_STARTED')) {
    die();
}

$conf = [
  'host' => getenv('DB_HOST'),
  'port' => getenv('DB_PORT'),
  'db_name' => getenv('DB_NAME'),
  'username' => getenv('DB_USERNAME'),
  'password' => getenv('DB_PASSWORD')
];

function getDbConnection(): PDO
{
    global $conf;
    $dbConnection = DbConnection::getInstance($conf['host'], $conf['port'], $conf['db_name'], $conf['username'], $conf['password']);
    return $dbConnection->getConnection();
}

function connectDb($host, $port, $dbName, $username, $password): PDO
{
    $pdo = new PDO("mysql:host={$host}:{$port};dbname={$dbName}",$username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

function insertUser(array $user): void
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


function getAllUsers(): array
{
    $pdo = getDbConnection();
    $result = $pdo->query('SELECT * FROM public.users');

    /**
     * PDO::FETCH_ASSOC превратит в ассоциативный массив, где ключ - название поля, значение - значение
     */
    $users = $result->fetchAll(PDO::FETCH_ASSOC);

    $result = [];
    foreach ($users as $userArray) {
        $result[] = createUserFromArray($userArray);
    }

    return $result;
}

function getUserById(int $id): User
{
    $pdo = getDbConnection();
    $stmt = $pdo->prepare('SELECT * FROM public.users WHERE id = :id');
    $stmt->bindParam('id', $id);

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);


    return createUserFromArray($result);
}

function createUserFromArray(array $result): Admin
{
    $user = new Admin();
    $user->setId($result['id']);
    $user->setName($result['name']);
    $user->setSurname($result['surname']);
    $user->setEmail($result['email']);
    $user->setPhone($result['phone']);
    $user->setCreatedAt($result['created_at']);

    return $user;
}

