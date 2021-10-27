<?php
declare(strict_types=1);

require_once 'UserSourceInterface.php';

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

        $users = array_map(function (array $userArray) {
            $user = new User();

            $user->setId($userArray['id']);
            $user->setName($userArray['name']);
            $user->setSurname($userArray['surname']);
            $user->setEmail($userArray['email']);
            $user->setPhone($userArray['phone']);
            $user->setCreatedAt($userArray['created_at']);

            return $user;
        }, $userData);

        return $users;
    }

    public function getUserById(int $id): ?User
    {
        // @TODO - реализовать
    }
}