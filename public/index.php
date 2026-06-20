<?php

require_once __DIR__ . '/../config/database.php';

require_once __DIR__ . '/../src/Middleware/AuthMiddleware.php';
require_once __DIR__ . '/../src/Repository/StockBatchRepository.php';
require_once __DIR__ . '/../src/Service/StockService.php';
require_once __DIR__ . '/../src/Repository/UserRepository.php';
require_once __DIR__ . '/../src/Service/AuthService.php';
require_once __DIR__ . '/../src/Entity/User.php';

require_once __DIR__ . '/../src/Controller/api/ApiStockController.php';
require_once __DIR__ . '/../src/Controller/api/ApiDashboardController.php';

require_once __DIR__ . '/../src/Controller/web/DashboardController.php';
require_once __DIR__ . '/../src/Controller/web/StockController.php';
require_once __DIR__ . '/../src/Controller/web/AuthController.php';
require_once __DIR__ . '/../src/Controller/api/ApiAdminController.php';
use PharmaFEFO\Controller\api\ApiStockController;
use PharmaFEFO\Controller\api\ApiDashboardController;

use PharmaFEFO\Controller\web\DashboardController;
use PharmaFEFO\Controller\web\StockController;
use PharmaFEFO\Controller\web\AuthController;
use PharmaFEFO\Controller\api\ApiAdminController;
session_start();

$apiStock = new ApiStockController();
$apiDashboard = new ApiDashboardController();

$dashboard = new DashboardController();
$stock = new StockController();
$auth = new AuthController();
$apiAdmin = new ApiAdminController();

$route = $_GET['route'] ?? '';

switch ($route) {

    /* ================= AUTH ================= */
    case 'login':
        $auth->showLogin();
        break;

    case 'login/store':
        $auth->login();
        break;

    case 'logout':
        $auth->logout();
        break;

    /* ================= WEB ================= */
    case 'dashboard':
        $dashboard->index();
        break;

    case 'stock':
        $stock->index();
        break;

    /* ================= API STOCK ================= */
    case 'api/stocks':
        $apiStock->index();
        break;

    case 'api/stocks/checkout':
        $apiStock->checkout();
        break;

    case 'api/stocks/add':
        $apiStock->add();
        break;

    case 'api/stocks/filter':
        $apiStock->filter();
        break;

    case 'api/stocks/stats':
        $apiStock->stats();
        break;

    /* ================= API DASHBOARD ================= */
    case 'api/dashboard':
        $apiDashboard->index();
        break;

    case 'api/admin/reports':
    $apiAdmin->reports();
    break;

    default:
        echo "404 - Route introuvable";
        break;
}