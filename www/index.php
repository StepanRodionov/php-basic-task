<?php
declare(strict_types=1);

use App\User;

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/requirements.php';

?>
<h1>Клиенты</h1>
<div>
    <h3>Добавить клиента</h3>
    <form action="/" method="POST">
        <input type="text" name="name" placeholder="Имя" /><br>
        <input type="text" name="surname" placeholder="Фамилия" /><br>
        <input type="text" name="phone" placeholder="Телефон" /><br>
        <input type="text" name="email" placeholder="Почта" /><br>
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
<?php
//  не используем альтернативный синтаксис foreach(): endforeach;
/** @var User $user */
foreach ($users as $user) { ?>

        <tr>
            <td>
                <a href="/personal.php?user_id=<?= $user->getId() ?>">
                    <?= $user->getId() ?>
                </a>
            </td>
            <td>
                <a href="/personal.php?user_id=<?= $user->getId() ?>">
                    <?= $user->getName() ?>
                </a>
            </td>
            <td>
                <a href="/personal.php?user_id=<?= $user->getId() ?>">
                    <?= $user->getSurname() ?>
                </a>
            </td>
            <td><?= $user->getPhone() ?></td>
            <td><?= $user->getEmail() ?></td>
            <td><?= $user->getCreatedAt() ?></td>
        </tr>
<?php } ?>
    </tbody>
</table>


