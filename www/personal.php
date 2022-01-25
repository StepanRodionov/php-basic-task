<?php
declare(strict_types=1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/requirements.php';


$userId = (int)$_GET['user_id'];
if ($userId < 1) {
    die('Некорректный id клиента!');
}
$user = getUserById($userId);

?>
<div>
    <h3>Данные клиента <b><?= $user->getFullName() ?></b></h3>
</div>
<table border="1">
    <tr>
        <td>Id клиента</td>
        <td><?= $user->getId() ?></td>
    </tr>
    <tr>
        <td>Имя</td>
        <td><?= $user->getName() ?></td>
    </tr>
    <tr>
        <td>Фамилия</td>
        <td><?= $user->getSurname() ?></td>
    </tr>
    <tr>
        <td>Телефон</td>
        <td><?= $user->getPhone() ?></td>
    </tr>
    <tr>
        <td>Почта</td>
        <td><?= $user->getEmail() ?></td>
    </tr>
    <tr>
        <td>Дата создания</td>
        <td><?= $user->getCreatedAt() ?></td>
    </tr>
</table>
<div>
    <a href="/">Вернуться к списку</a>
</div>