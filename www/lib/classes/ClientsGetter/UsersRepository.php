<?php
declare(strict_types=1);

namespace App\ClientsGetter;

use App\User;

class UsersRepository
{
    private UserSourceInterface $usersSource;

    public function __construct(UserSourceInterface $usersSource)
    {
        $this->usersSource = $usersSource;
    }

    /**
     * @return array|User[]
     */
    public function getUsers(): array
    {
        $userData = $this->usersSource->getUsersData();

        $users = array_map(static function (array $userArray) {
            return User::createFromRawData($userArray);
        }, $userData);

        return $users;
    }

    public function getUserById(int $id): ?User
    {
        // @TODO - реализовать
    }
}