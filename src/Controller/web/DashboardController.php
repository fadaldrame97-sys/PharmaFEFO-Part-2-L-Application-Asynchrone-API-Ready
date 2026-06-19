<?php

namespace PharmaFEFO\Controller\Web;
use PharmaFEFO\Middleware\AuthMiddleware;

class DashboardController

{
    public function index(): void
    {
          AuthMiddleware::check(['ADMIN', 'PHARMACIEN']);
        //if (session_status() === PHP_SESSION_NONE) {
            //session_start();
       // }

       
        //if (!isset($_SESSION['user_id'])) {
            //header('Location: /login');
            //exit;
       // }

        // Chargement de la vue
        require __DIR__ . '/../../../templates/dashboard/index.php';
    }
}