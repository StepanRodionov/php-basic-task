<?php
declare(strict_types=1);

use Otus\Demoapp\GlobalSettings;
use Symfony\Component\Yaml\Yaml;

error_reporting(E_ALL);
ini_set('display_startup_errors', '1');
ini_set('display_errors', '1');

const APP_STARTED = true;
const APP_ENV = 'dev';
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
$dotenv->load();

// dd($_ENV);   // Наши envs тут!

$settings = Yaml::parseFile($_SERVER['DOCUMENT_ROOT'] . '/setup/settings.yaml');

GlobalSettings::createFromArray($settings);

// dd($settings);  // Наш конфиг тут

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
