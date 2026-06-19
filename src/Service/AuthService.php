<?php

namespace PharmaFEFO\Service;

use PharmaFEFO\Repository\UserRepository;
use PharmaFEFO\Entity\User; 

class AuthService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

public function login(string $email, string $password): ?User {
    $user = $this->userRepository->findByEmail($email);

    if (!$user) {
        return null;
    }

   if ($password !== $user->getPassword()) {
    return null;
}

    return $user; // objet User
}

}