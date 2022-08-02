<?php
declare(strict_types=1);

namespace App;

class User
{
    private ?int $id;
    private string $name;
    private string $surname;
    private string $phone;
    private ?string $email;
    private ?string $createdAt;

    public function __construct(
        string $name,
        string $surname,
        string $phone,
        ?string $email = null
    ) {
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->email = $email;
    }

    public static function createFromRawData(array $userData): User
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

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return User
     */
    public function setId(?int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return User
     */
    public function setSurname(string $surname): User
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return User
     */
    public function setPhone(string $phone): User
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return User
     */
    public function setEmail(?string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @param string|null $createdAt
     * @return User
     */
    public function setCreatedAt(?string $createdAt): User
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getFullName(): string
    {
        return $this->name . ' ' . $this->surname;
    }

    public function isValid(): bool
    {
        return $this->getName() && $this->getSurname() && $this->getPhone();
    }
}