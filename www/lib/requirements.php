<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_startup_errors', '1');
ini_set('display_errors', '1');

const APP_STARTED = true;
session_start();

require_once 'User.php';
require_once 'form.php';
require_once 'db.php';
require_once 'log.php';

### Классы по работе с пользователями ###
require_once 'classes/ClientsGetter/DBUserSource.php';
require_once 'classes/ClientsGetter/FileUserSource.php';
require_once 'classes/ClientsGetter/HttpUserSource.php';
require_once 'classes/ClientsGetter/LocalUserSource.php';
require_once 'classes/ClientsGetter/UserSourceInterface.php';
require_once 'classes/ClientsGetter/UsersRepository.php';

function dd($val)
{
    var_dump($val);
    die();
}