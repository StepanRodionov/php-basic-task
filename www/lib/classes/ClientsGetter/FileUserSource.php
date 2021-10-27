<?php
declare(strict_types=1);

require_once 'LocalUserSource.php';

class FileUserSource extends LocalUserSource
{
    static protected string $filename = '/setup/usersWithIds.csv';

    protected function doConnect()
    {
        return fopen($_SERVER['DOCUMENT_ROOT'] . self::$filename, 'rb');
    }

    protected function getData(): array
    {
        $users = [];
        while ($row = fgetcsv($this->connection, 1024, ';')) {
            $users[] = $row;
        }
        // Первая строка - это заголовок, удаляем ее
        array_shift($users);

        $usersArray = [];
        foreach ($users as $user) {
            $userData = [];
            $userData['id'] = $user[0];
            $userData['name'] = $user[1];
            $userData['surname'] = $user[2];
            $userData['phone'] = $user[3];
            $userData['email'] = $user[4];
            $userData['created_at'] = $user[5];
            $usersArray[] = $userData;
        }

        return $usersArray;
    }
}