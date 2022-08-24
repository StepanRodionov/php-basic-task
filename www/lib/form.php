<?php
declare(strict_types=1);

use App\ClientsGetter\Singleton;
use App\User;

if (!defined('APP_STARTED')) {
    die();
}

require_once 'db.php';
require_once 'log.php';

$type = $_POST['type'] ?? null;
if (!isset($_POST['type'])) {
    return;
}
$csrfToken = $_POST['csrf-token'];
if ($csrfToken !== '6154ae4355669') {
    die('You shall not pass!');
}
$formResult = null;

switch ($type) {
    case 'add_user':
        $formResult = addUser();
        header("Location: http://{$_SERVER['HTTP_HOST']}/");
        break;
    case 'import_users':
        $formResult = importUsers();
        header("Location: http://{$_SERVER['HTTP_HOST']}/");
        break;
    default:
        die('Неверное действие!');
}

function addUser()
{
    $user = new User(
        htmlspecialchars($_POST['name']),
        htmlspecialchars($_POST['surname']),
        htmlspecialchars($_POST['phone']),
        htmlspecialchars($_POST['email'])
    );

    if (!$user->isValid()) {
        die('Имя, фамилия и телефон обязательны!');
    }

    // Обработаем ошибку БД, если она случится
    try{
        insertUser($user);
        logData("Добавлен клиент {$user->getFullName()}");
    } catch (Throwable $e) {
        logData($e->getMessage());
        var_dump($e);
    }

    return 'add_success';
}

function importUsers()
{
    $file = $_FILES['import_data'];
    if (!$file) {
        die('Нет файла с клиентами');
    }

    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/storage/';
    $uploadfile = $uploaddir . basename($file['name']);

    if (!move_uploaded_file($file['tmp_name'], $uploadfile)) {
        die('Не удалось сохранить файл');
    }

    $users = [];
    $fp = fopen($uploadfile, 'rb');
    while ($row = fgetcsv($fp, 1024, ';')) {
        $users[] = $row;
    }
    // Первая строка - это заголовок, удаляем ее
    array_shift($users);

    $i = 1;
    foreach ($users as $userData) {
        $user = new User(
            htmlspecialchars($userData[0]),
            htmlspecialchars($userData[1]),
            htmlspecialchars($userData[2]),
            htmlspecialchars($userData[3])
        );

        // Имя и фамилия обязательны!
        if (!$user->isValid()) {
            logData("Ошибка в строке $i: не хватает обязательных полей");
            continue;
        }
        insertUser($user);
        logData("Импортирован клиент {$user->getFullName()}");
        $i++;
    }

    return 'import_success';
}
