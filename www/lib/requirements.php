<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

const APP_STARTED = true;
session_start();

require_once 'form.php';
require_once 'db.php';

function dd($val)
{
    var_dump($val);
    die();
}