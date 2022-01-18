<?php
declare(strict_types=1);

if (!defined('APP_STARTED')) {
    die();
}

$logPath = $_SERVER['DOCUMENT_ROOT'] . '/storage/log.txt';

function logData(string $logData): void
{
    global $logPath;
    $fp = fopen($logPath, 'ab');
    $logData = sprintf(
        '%s %s%s',
        date('Y-m-d H:i:s'),
        $logData,
        PHP_EOL
    );
    fwrite($fp, $logData);
    fclose($fp);
}
