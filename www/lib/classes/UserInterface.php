<?php

namespace App;

interface UserInterface
{
    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @param int|null $id
     * @return User
     */
    public function setId(?int $id): User;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): User;

    /**
     * @return string
     */
    public function getSurname(): string;

    /**
     * @param string $surname
     * @return User
     */
    public function setSurname(string $surname): User;

    /**
     * @return string
     */
    public function getPhone(): string;

    /**
     * @param string $phone
     * @return User
     */
    public function setPhone(string $phone): User;

    /**
     * @return string|null
     */
    public function getEmail(): ?string;

    /**
     * @param string|null $email
     * @return User
     */
    public function setEmail(?string $email): User;

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * @param string|null $createdAt
     * @return User
     */
    public function setCreatedAt(?string $createdAt): User;

    public function getFullName(): string;

    public function isValid(): bool;
}