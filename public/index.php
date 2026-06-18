<?php

require_once __DIR__ . '/../config/database.php';

require_once __DIR__ . '/../src/Repository/StockBatchRepository.php';
require_once __DIR__ . '/../src/Service/StockService.php';
require_once __DIR__ . '/../src/Controller/Api/ApiStockController.php';
require_once __DIR__ . '/../src/Controller/web/DashboardController.php';

use PharmaFEFO\Controller\Api\ApiStockController;
use PharmaFEFO\Controller\Web\DashboardController;

$Apicontroller = new ApiStockController();
$dashboardWebcontr = new DashboardController();

$apiAction = $_GET['action']?? null;
$route = $_GET['route'] ?? '';
if ($route === 'api'){
    switch ($apiAction) {
    case 'stocks':
        $Apicontroller->index();
        break;

    case 'stocks/critical':
        $Apicontroller->critical();
        break;

    case 'stocks/checkout':
        $Apicontroller->checkout();
        break;
}
}

    switch ($route) {
    case 'dashboard':
        $dashboardWebcontr->index();
        break;
}





