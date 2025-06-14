<?php

namespace App\Application\Controllers;

use App\Application\Services\UserService;
use App\Domain\DTO\UserDTO;
use App\Infrastructure\DAO\UserRepository;

class UserController
{
    private UserService $userService;

    public function __construct()
    {
        $userRepository = new UserRepository();
        $this->userService = new UserService($userRepository);
    }

    public function register($username, $password)
    {
        $userDTO = new UserDTO($username, $password);
        return $this->userService->register($userDTO);
    }

    public function login($username, $password)
    {
        return $this->userService->login($username, $password);
    }

    public function getUser($token)
    {
        return $this->userService->getUser($token);
    }
}
