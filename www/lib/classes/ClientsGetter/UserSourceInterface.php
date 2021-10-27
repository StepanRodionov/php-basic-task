<?php

declare(strict_types=1);

interface UserSourceInterface
{
    public function getUsersData(): array;

    public function getUserDataById(int $id): array;
}