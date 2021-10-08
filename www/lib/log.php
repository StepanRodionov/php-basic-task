<?php
declare(strict_types=1);

try{
    $logFile = fopen($_SERVER['DOCUMENT_ROOT'] . '/storage/log.txt', 'a+');
} catch (Exception $e) {
    dd($e);
}

function logData(string $log): void
{
    global $logFile;
    $log2 = (new DateTime())->format('Y-m-d H:i:s') . ' ' . $log;
    fwrite($logFile, $log2 . PHP_EOL);
}
