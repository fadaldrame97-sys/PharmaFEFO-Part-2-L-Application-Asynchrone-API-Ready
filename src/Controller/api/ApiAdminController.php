<?php

namespace PharmaFEFO\Controller\api;

use PharmaFEFO\Service\StockService;
use PharmaFEFO\Middleware\AuthMiddleware;

class ApiAdminController
{
    private StockService $stockService;

    public function __construct()
    {
        $this->stockService = new StockService();
    }

    // Rapport pertes admin
    public function reports(): void
    {
        AuthMiddleware::check(['ADMIN']);

        header('Content-Type: application/json');

        $totalLoss = $this->stockService->getTotalLoss();

        echo json_encode([
            "status" => 200,
            "total_loss" => $totalLoss
        ]);
    }

    // stats admin
    public function stats(): void
    {
        AuthMiddleware::check(['ADMIN']);

        header('Content-Type: application/json');

        echo json_encode([
            "status" => 200,
            "total_loss" => $this->stockService->getTotalLoss(),
            "critical_batches" => $this->stockService->getCriticalBatches()
        ]);
    }
}