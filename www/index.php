<?php
declare(strict_types=1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/requirements.php';

if (!isset($_GET['user_id'])) {
?>
<h1>Клиенты</h1>
<div>
    <h3>Добавить клиента</h3>
    <form action="/" method="POST">
        <input type="text" name="name" placeholder="Имя" /><br>
        <input type="text" name="surname" placeholder="Фамилия" /><br>
        <input type="text" name="phone" placeholder="Телефон" /><br>
        <input type="email" name="email" placeholder="Почта" /><br>
        <input type="hidden" name="csrf-token" value='6154ae4355669'/>
        <input type="hidden" name="type" value='add_user'/>
        <input type="submit" value ="Отправить">
    </form>
</div>
<br>
<hr>
<br>
<div>
    <h3>Массовый импорт клиентов</h3>
    <form action="/" enctype="multipart/form-data" method="POST">
        <input type="file" name="import_data" accept="text/csv" /><br>
        <input type="hidden" name="csrf-token" value='6154ae4355669'/>
        <input type="hidden" name="type" value='import_users'/>
        <input type="submit" value ="Загрузить пользователей">
    </form>
</div>
<?php $users = getAllUsers(); ?>

<table border="1">
    <thead>
        <tr>
            <td>Номер</td>
            <td>Имя</td>
            <td>Фамилия</td>
            <td>Телефон</td>
            <td>Почта</td>
            <td>Дата создания</td>
        </tr>
    </thead>
    <tbody>
<?php //  не используем альтернативный синтаксис foreach(): endforeach;
foreach ($users as $user) { ?>

        <tr>
            <td>
                <a href="/?user_id=<?= $user['id']?>">
                    <?= $user['id']?>
                </a>
            </td>
            <td>
                <a href="/?user_id=<?= $user['id']?>">
                    <?= $user['name']?>
                </a>
            </td>
            <td>
                <a href="/?user_id=<?= $user['id']?>">
                    <?= $user['surname']?>
                </a>
            </td>
            <td><?= $user['phone']?></td>
            <td><?= $user['email']?></td>
            <td><?= $user['created_at']?></td>
        </tr>
<?php } ?>
    </tbody>
</table>

<?php
} else {
    $userId = (int)$_GET['user_id'];
    if ($userId < 1) {
        die('Некорректный id клиента!');
    }
    $user = getUserById($userId);
?>
    <div>
        <h3>Данные клиента <b><?= $user['name'] . ' ' . $user['surname'] ?></b></h3>
    </div>
    <table border="1">
        <tr>
            <td>Id клиента</td>
            <td><?= $user['id']?></td>
        </tr>
        <tr>
            <td>Имя</td>
            <td><?= $user['name']?></td>
        </tr>
        <tr>
            <td>Фамилия</td>
            <td><?= $user['surname']?></td>
        </tr>
        <tr>
            <td>Телефон</td>
            <td><?= $user['phone']?></td>
        </tr>
        <tr>
            <td>Почта</td>
            <td><?= $user['email']?></td>
        </tr>
        <tr>
            <td>Дата создания</td>
            <td><?= $user['created_at']?></td>
        </tr>
    </table>
    <div>
        <a href="/">Вернуться к списку</a>
    </div>
<?php }
