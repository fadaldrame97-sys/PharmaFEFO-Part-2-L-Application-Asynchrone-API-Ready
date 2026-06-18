<?php

require_once __DIR__ . '/../src/Controller/Web/DashboardController.php';
require_once __DIR__ . '/../src/Controller/Api/ApiStockController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/PharmaFEFO-Part-2-L-Application-Asynchrone-API-Ready/public/' || $uri === '/PharmaFEFO-Part-2-L-Application-Asynchrone-API-Ready/public/index.php') {

    $controller = new \PharmaFEFO\Controller\Web\DashboardController();
    $controller->index();
    exit;
}

if ($uri === '/PharmaFEFO-Part-2-L-Application-Asynchrone-API-Ready/public/api/v1/batches') {

    $controller = new \PharmaFEFO\Controller\Api\ApiStockController();
    $controller->index();
    exit;
}