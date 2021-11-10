<?php

declare(strict_types=1);

interface ClientInterface
{
    public function getOrdersData(): array;

    public function setOrdersData(array $ordersData): void;

    public function getName(): string;

    public function setName(string $name): void;

    public function getEmail(): string;

    public function setEmail(string $email): void;
}