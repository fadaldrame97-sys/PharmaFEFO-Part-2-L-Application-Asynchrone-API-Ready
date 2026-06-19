<?php

namespace PharmaFEFO\Middleware;

class AuthMiddleware
{

      public static function check(array $roles = []): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?route=login');
            exit;
        }

        if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], $roles)) {
            http_response_code(403);
            echo "Accès refusé";
            exit;
        }
    }
}    