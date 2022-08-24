<?php
declare(strict_types=1);

namespace App\ClientsGetter;

use App\User;
use App\UserFactory;
use App\UserInterface;

class UsersRepository
{
    private UserSourceInterface $usersSource;

    public function __construct(UserSourceInterface $usersSource)
    {
        $this->usersSource = $usersSource;
    }

    /**
     * @return array|UserInterface[]
     */
    public function getUsers(): array
    {
        $userData = $this->usersSource->getUsersData();

        $users = array_map(static function (array $userArray) {
            return UserFactory::createUserFromRawData($userArray);
        }, $userData);

        return $users;
    }

    public function getUserById(int $id): ?User
    {
        // @TODO - реализовать
    }
}