<?php

namespace PharmaFEFO\Controller\Web;

class DashboardController
{
    public function index(): void
    {
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

       
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        // Chargement de la vue
        require __DIR__ . '/../../../templates/dashboard/index.php';
    }
}