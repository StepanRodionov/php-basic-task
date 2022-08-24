<?php

namespace App;

class UserFactory
{
    public static function createUserFromRawData(array $userData): UserInterface
    {
        $user = new User(
            $userData['name'],
            $userData['surname'],
            $userData['phone'],
            $userData['email'],
        );

        $user
            ->setId((int)$userData['id'])
            ->setCreatedAt($userData['created_at']);

        return new LoggedUserDecorator($user);
    }

    public static function createRawUserFromArray(array $userData): User
    {
        $user = new User(
            $userData['name'],
            $userData['surname'],
            $userData['phone'],
            $userData['email'],
        );

        return $user
            ->setId((int)$userData['id'])
            ->setCreatedAt($userData['created_at']);
    }
}