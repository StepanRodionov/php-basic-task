<?php

$conf = [
  'host' => 'mysql',
  'port' => 3306,
  'db_name' => 'public',
  'username' => 'root',
  'password' => 'example'
];

function connect($host, $port, $dbName, $username, $password) {
    $pdo = new PDO("mysql:host={$host}:{$port};dbname={$dbName}",$username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

function addMessage($username, $message, $picture = '')
{
    global $conf;
    $pdo = connect($conf['host'], $conf['port'], $conf['db_name'], $conf['username'], $conf['password']);
    $date = date('Y-m-d');
    $statement = $pdo->prepare("insert into messages(username, message, date, picture) values(:username, :message, :date, :picture)");
    $statement->execute([
        ':username' => $username,
        ':message' => $message,
        ':date' => $date,
        ':picture' => $picture
    ]);
}

function getMessages()
{
    global $conf;
    $pdo = connect($conf['host'], $conf['port'], $conf['db_name'], $conf['username'], $conf['password']);
    $statement = $pdo->query("select * from messages");
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getMessagesByUserName($username)
{
    global $conf;
    $pdo = connect($conf['host'], $conf['port'], $conf['db_name'], $conf['username'], $conf['password']);
    $statement = $pdo->prepare ("select * from messages where username = :username");
    $statement->execute([':username' => $username]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
