<?php
namespace PharmaFEFO\Controller\Web;

use PharmaFEFO\Middleware\AuthMiddleware;

class StockController {
    public function index(): void {
        AuthMiddleware::check(['ADMIN', 'PREPARATEUR']);
        require __DIR__ . '/../../../templates/stock/index.php';
    }
}
