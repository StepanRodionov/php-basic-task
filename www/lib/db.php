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
  'password' => 'ad9NSgzgioyf'
];

$connection = null;


class DbConnection
{
    private static $instance = null;

    protected $connection;

    protected function __construct($host, $port, $dbName, $username, $password)
    {
        $this->connection = new PDO("mysql:host={$host}:{$port};dbname={$dbName}",$username, $password);
    }

    protected function __clone(): void
    {
    }

    public static function getInstance($host, $port, $dbName, $username, $password) {
        if (!self::$instance) {
            self::$instance = new DbConnection($host, $port, $dbName, $username, $password);
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}


$dbConnection = DbConnection::getInstance($conf['host'], $conf['port'], $conf['db_name'], $conf['username'], $conf['password']);
$dbConnection2 = DbConnection::getInstance($conf['host'], $conf['port'], $conf['db_name'], $conf['username'], $conf['password']);
$dbConnection3 = DbConnection::getInstance($conf['host'], $conf['port'], $conf['db_name'], $conf['username'], $conf['password']);
$dbConnection4 = DbConnection::getInstance($conf['host'], $conf['port'], $conf['db_name'], $conf['username'], $conf['password']);
$dbConnection5 = DbConnection::getInstance($conf['host'], $conf['port'], $conf['db_name'], $conf['username'], $conf['password']);
$dbConnection6 = DbConnection::getInstance($conf['host'], $conf['port'], $conf['db_name'], $conf['username'], $conf['password']);


$pdo = $dbConnection6->getConnection();

$res = $pdo->query('Select * from `users`')->fetchAll();


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

