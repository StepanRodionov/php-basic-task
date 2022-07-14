<?php
declare(strict_types=1);

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
    $userData = [];
    $userData['NAME'] = htmlspecialchars($_POST['name']);
    $userData['SURNAME'] = htmlspecialchars($_POST['surname']);
    $userData['PHONE'] = htmlspecialchars($_POST['phone']);
    $userData['EMAIL'] = htmlspecialchars($_POST['email']);

    // Имя и фамилия обязательны!
    if (!$userData['NAME'] || !$userData['SURNAME'] || !$userData['PHONE']) {
        die('Имя, фамилия и телефон обязательны!');
    }

    // Обработаем ошибку БД, если она случится
    try{
        insertUser($userData);
        logData("Добавлен клиент {$userData['NAME']} {$userData['SURNAME']}");
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

    $userData = [];
    $i = 1;
    foreach ($users as $user) {
        $userData['NAME'] = htmlspecialchars($user[0]);
        $userData['SURNAME'] = htmlspecialchars($user[1]);
        $userData['PHONE'] = htmlspecialchars($user[2]);
        $userData['EMAIL'] = htmlspecialchars($user[3]);

        // Имя и фамилия обязательны!
        if (!$userData['NAME'] || !$userData['SURNAME'] || !$userData['PHONE']) {
            logData("Ошибка в строке $i: не хватает обязательных полей");
            continue;
        }
        insertUser($userData);
        logData("Импортирован клиент {$userData['NAME']} {$userData['SURNAME']}");
        $i++;
    }

    return 'import_success';
}
