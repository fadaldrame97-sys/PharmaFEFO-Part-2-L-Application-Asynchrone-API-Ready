<?php

namespace PharmaFEFO\Controller\Web;
use PharmaFEFO\Middleware\AuthMiddleware;


class AdminController
{
    public function reports(): void
    {
        session_start();

        AuthMiddleware::check(['ADMIN', 'PREPARATEUR']);

        
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'ADMIN') {
            http_response_code(403);
            echo "Accès interdit";
            exit;
        }

        require __DIR__ . '/../../../templates/admin/reports.php';
    }
}