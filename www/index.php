<?php
declare(strict_types=1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/requirements.php';
?>
<div>
    <span>Добавить пользователя</span>
    <form action="/" method="POST">
        <input type="text" name="name" placeholder="Имя" /><br>
        <input type="text" name="surname" placeholder="Фамилия" /><br>
        <input type="text" name="phone" placeholder="Телефон" /><br>
        <input type="email" name="email" placeholder="Почта" /><br>
        <input type="hidden" name="csrf-token" value='6154ae4355669'/>
        <input type="hidden" name="type" value='add_user'/>
        <input type="submit" value ="Отправить">
    </form>
    <?php if ($formResult === 'add_success') {
        echo "<span>Пользователь добавлен!</span>";
    } ?>
</div>
<br>
<hr>
<br>
<div>
    <span>Массовый импорт пользователей</span>
    <form action="/" enctype="multipart/form-data" method="POST">
        <input type="file" name="import_data" accept="text/csv" /><br>
        <input type="hidden" name="csrf-token" value='6154ae4355669'/>
        <input type="hidden" name="type" value='import_users'/>
        <input type="submit" value ="Загрузить пользователей">
    </form>
    <?php if ($formResult === 'import_success') {
        echo "<span>Импорт прошел успешно</span>";
    } ?>
</div>
<?php
    //  TODO - выборка пользователей
?>

<!-- TODO - вывод пользователей -->
