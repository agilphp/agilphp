<?php

namespace App\Domain\Interfaces;

use App\Domain\DTO\UserDTO;

interface UserRepositoryInterface
{
    public function create(UserDTO $user): void;
    public function findByUsername(string $username): ?array;
}
