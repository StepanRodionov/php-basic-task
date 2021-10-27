<?php
declare(strict_types=1);

require_once 'UserSourceInterface.php';

class HttpUserSource implements UserSourceInterface
{

    public function getUsersData(): array
    {
        $usersJson = file_get_contents("http://{$_SERVER['HTTP_HOST']}/external/clients.json");
        $clientsData = json_decode($usersJson, true);

        return $clientsData['clients'];
    }

    public function getUserDataById(int $id): array
    {
        // TODO: Implement getUserDataById() method.
    }
}