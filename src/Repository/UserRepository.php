<?php

namespace PharmaFEFO\Repository;

use PDO;
use Database;
use PharmaFEFO\Entity\User;

class UserRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

public function findByEmail(string $email): ?User {
    $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) return null;

    return new User(
        (int)$row['id'],
        $row['email'],
        $row['password'],
        $row['role']
    );
}

}