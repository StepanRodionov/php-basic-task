<?php
declare(strict_types=1);

require_once 'db.php';

$type = $_POST['type'];
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
        break;
    case 'import_users':
        $formResult = importUsers();
        break;
    default:
        die('Неверное действие!');
}

function addUser()
{
    $userData = [];
    $userData['NAME'] = $_POST['name'];
    $userData['SURNAME'] = $_POST['surname'];
    $userData['PHONE'] = $_POST['phone'];
    $userData['EMAIL'] = $_POST['email'];

    // Имя и фамилия обязательны!
    if (!isset($userData['NAME']) || !isset($userData['NAME'])) {
        die('Имя и фамилия обязательны');
    }

    // Обработаем ошибку БД, если она случится
    try{
        insertUser($userData);
    } catch (Throwable $e) {
        var_dump($e);
    }

    return 'add_success';
}

function importUsers()
{
    // TODO - import users from csv
    return 'import_success';
}
