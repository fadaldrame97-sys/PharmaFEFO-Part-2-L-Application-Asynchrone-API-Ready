<?php

namespace PharmaFEFO\Controller\Api;

use PharmaFEFO\Service\StockService;
use PharmaFEFO\Middleware\AuthMiddleware;

class ApiStockController
{
    private StockService $stockService;

    public function __construct()
    {
        $this->stockService = new StockService();
    }

    public function index(): void

    {

        AuthMiddleware::check(['ADMIN', 'PHARMACIEN', 'PREPARATEUR']);
        header('Content-Type: application/json');

        $data = $this->stockService->getAllBatches();

        echo json_encode([
            "status" => 200,
            "data" => $data
        ]);
    }

    public function checkout(): void
    {
        header('Content-Type: application/json');

        $input = json_decode(file_get_contents("php://input"), true);
        $productId = $input['product_id'] ?? null;

        if (!$productId) {
            http_response_code(400);
            echo json_encode([
                "status" => 400,
                "message" => "product_id requis"
            ]);
            return;
        }

        $result = $this->stockService->checkout($productId);

        if (!$result['success']) {
            http_response_code(400);
        }

        echo json_encode($result);
    }

    public function critical(): void
    {
        header('Content-Type: application/json');

        $data = $this->stockService->getCriticalBatches();

        echo json_encode([
            "status" => 200,
            "data" => $data
        ]);
    }
}