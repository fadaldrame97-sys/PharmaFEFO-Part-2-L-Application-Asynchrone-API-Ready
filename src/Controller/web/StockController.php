<?php
namespace PharmaFEFO\Controller\web;

use PharmaFEFO\Middleware\AuthMiddleware;




class StockController {
    public function index(): void {
        AuthMiddleware::check(['ADMIN', 'PREPARATEUR']);
        require __DIR__ . '/../../../templates/stock/index.php';
    }
}
