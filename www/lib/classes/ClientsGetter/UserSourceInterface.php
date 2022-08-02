<?php
declare(strict_types=1);

namespace App\ClientsGetter;

interface UserSourceInterface
{
    public function getUsersData(): array;

    public function getUserDataById(int $id): array;
}