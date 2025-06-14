<?php

namespace App\Infrastructure\DAO;

use App\Domain\DTO\UserDTO;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Infrastructure\Database\Connection;

class UserRepository implements UserRepositoryInterface
{
    public function create(UserDTO $user): void
    {
        $pdo = Connection::getPDO();

        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute([
            'username' => $user->username,
            'password' => password_hash($user->password, PASSWORD_BCRYPT),
        ]);
    }

    public function findByUsername(string $username): ?array
    {
        $pdo = Connection::getPDO();

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        return $user ?: null;
    }
}
