<?php

declare(strict_types=1);

namespace PharmaFEFO\Controller\Web;

use PharmaFEFO\Service\AuthService;

class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

   
    public function showLogin(): void
    {
        require __DIR__ . '/../../../templates/auth/login.php';
    }

   
    public function login(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Adresse e-mail invalide.";
            header('Location: index.php?route=login');
            exit;
        }

        $user = $this->authService->login($email, $password);

        if ($user === null) {
            $_SESSION['error'] = "Email ou mot de passe incorrect.";
            header('Location: index.php?route=login');
            exit;
        }

        $_SESSION['user_id'] = $user->getId();
        $_SESSION['user_email'] = $user->getEmail();
        $_SESSION['user_role'] = $user->getRole();

        switch ($user->getRole()) {

            case 'ADMIN':
                header('Location: index.php?route=dashboard');
                break;

            case 'PHARMACIEN':
                header('Location: index.php?route=dashboard');
                break;

            case 'PREPARATEUR':
                header('Location: index.php?route=stock');
                break;

            default:
                session_destroy();
                header('Location: index.php?route=login');
                break;
            }

            exit;
    }

   
    public function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];

        session_destroy();

        header('Location: index.php?route=login');
        exit;
    }
}