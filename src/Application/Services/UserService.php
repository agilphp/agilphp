<?php

namespace App\Application\Services;

use App\Domain\DTO\UserDTO;
use App\Domain\Interfaces\UserRepositoryInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UserService
{
    private UserRepositoryInterface $userRepository;
    private string $secretKey = 'your-secret-key';

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserDTO $user): array
    {
        $this->userRepository->create($user);
        return ['message' => 'User registered successfully'];
    }

    public function login(string $username, string $password): array
    {
        $user = $this->userRepository->findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            $payload = [
                'sub' => $user['id'],
                'username' => $user['username'],
                'iat' => time(),
                'exp' => time() + 3600
            ];

            $jwt = JWT::encode($payload, $this->secretKey, 'HS256');

            return ['token' => $jwt];
        }

        return ['error' => 'Invalid credentials'];
    }

    public function getUser(string $token): array
    {
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));

            return ['id' => $decoded->sub, 'username' => $decoded->username];
        } catch (\Exception $e) {
            return ['error' => 'Invalid token'];
        }
    }
}
