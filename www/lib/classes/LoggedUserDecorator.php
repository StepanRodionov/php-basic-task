<?php

namespace App;

class LoggedUserDecorator implements UserInterface
{
    private UserInterface $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function getId(): ?int
    {
        return $this->user->getId();
    }

    public function setId(?int $id): User
    {
        return $this->user->setId($id);
    }

    public function getName(): string
    {
        return $this->user->getName();
    }

    public function setName(string $name): User
    {
        // TODO: Implement setName() method.
    }

    public function getSurname(): string
    {
        return $this->user->getSurname();
    }

    public function setSurname(string $surname): User
    {
        logData(
            sprintf(
                'Декорировано!!!! Фамилия пользователя %d поменялась. Было %s, стало %s',
                $this->getId(),
                $this->getPhone(),
                $surname
            )
        );
        return $this->user->setSurname($surname);
    }

    public function getPhone(): string
    {
        return $this->user->getPhone();
    }

    public function setPhone(string $phone): User
    {
        logData(
            sprintf(
                'Декорировано!!!! Телефон пользователя %d поменялся. Было %s, стало %s',
                $this->getId(),
                $this->getPhone(),
                $phone
            )
        );
        return $this->user->setPhone($phone);
    }

    public function getEmail(): ?string
    {
        return $this->user->getEmail();
    }

    public function setEmail(?string $email): User
    {
        // TODO: Implement setEmail() method.
    }

    public function getCreatedAt(): ?string
    {
        return $this->user->getCreatedAt();
    }

    public function setCreatedAt(?string $createdAt): User
    {
        // TODO: Implement setCreatedAt() method.
    }

    public function getFullName(): string
    {
        return $this->user->getFullName();
    }

    public function isValid(): bool
    {
        return $this->user->isValid();
    }
}