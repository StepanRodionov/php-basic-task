<?php
declare(strict_types=1);

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Otus\Demoapp\GlobalSettings;

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/requirements.php';

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
<?php
$settings = GlobalSettings::getInitialisedSettings();
$sourceClass = $settings['services']['user_source'];

    $source = new $sourceClass();
    if(!$source->getConnection()){
        throw new Exception('Error db connection');
    }


$userRepository = new UsersRepository($source);


?>

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

$logger = new Logger('my_logger');
$logger->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . '/storage/monolog.log', Logger::INFO));
$logger->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . '/storage/errors.log', Logger::ERROR));


/** @var User $user */


foreach ($users as $user) {
    $logger->info('Получены данные пользователя', ['user' => $user->toArray()]);
    $logger->info('Получены данные пользователя', ['user' => $user->toArray()]);
    $logger->info('Получены данные пользователя', ['user' => $user->toArray()]);

    ?>

        <tr>
            <td>
                <a href="/personal.php?user_id=<?= $user->getId() ?>">
                    <?= $user->getId() ?>
                </a>
            </td>
            <td>
                <a href="/personal.php?user_id=<?= $user->getId() ?>">
                    <?= $user->getName()?>
                </a>
            </td>
            <td>
                <a href="/personal.php?user_id=<?= $user->getId() ?>">
                    <?= $user->getSurname() ?>
                </a>
            </td>
            <td><?= $user->getPhone() ?></td>
            <td><?= $user->getEmail()?></td>
            <td><?= $user->getCreatedAt()?></td>
        </tr>
<?php }
$logger->error('Какая-то ошибка');
?>
    </tbody>
</table>


