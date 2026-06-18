<?php

require_once __DIR__ . '/../config/database.php';

require_once __DIR__ . '/../src/Repository/StockBatchRepository.php';
require_once __DIR__ . '/../src/Service/StockService.php';
require_once __DIR__ . '/../src/Controller/Api/ApiStockController.php';

use PharmaFEFO\Controller\Api\ApiStockController;

$controller = new ApiStockController();


$route = $_GET['route'] ?? '';

switch ($route) {
    case 'api/stocks':
        $controller->index();
        break;

    case 'api/stocks/critical':
        $controller->critical();
        break;

    case 'api/stocks/checkout':
        $controller->checkout();
        break;
}