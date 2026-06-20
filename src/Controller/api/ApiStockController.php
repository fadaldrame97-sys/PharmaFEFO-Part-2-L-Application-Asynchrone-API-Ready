<?php

namespace PharmaFEFO\Controller\api;

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

       //if (session_status() === PHP_SESSION_NONE) {
       // session_start();
       //}

        AuthMiddleware::check(['ADMIN', 'PHARMACIEN', 'PREPARATEUR']);
        header('Content-Type: application/json');
         
        $role = $_SESSION['user_role'] ?? null;
        $data = $this->stockService->getAllBatches();

        //var_dump($role);
        //var_dump($data);
         //exit;
    if ($role === 'PREPARATEUR') {
    $data = array_values(array_filter($data, function ($b) {
        return !empty($b['quantity']) && (int)$b['quantity'] > 0;
    }));
}
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


    public function add(): void
{
    AuthMiddleware::check(['PREPARATEUR']);

    header('Content-Type: application/json');

    $input = json_decode(file_get_contents("php://input"), true);

    if (!$input) {
        http_response_code(400);
        echo json_encode([
            "status" => 400,
            "message" => "Données invalides"
        ]);
        return;
    }

    $result = $this->stockService->addBatch($input);

    echo json_encode([
        "status" => 200,
        "message" => "Lot ajouté avec succès",
        "data" => $result
    ]);
}


public function listByCriteria(): void
{
    AuthMiddleware::check(['ADMIN', 'PHARMACIEN', 'PREPARATEUR']);

    header('Content-Type: application/json');

    $criteria = $_GET['criteria'] ?? 'all';

    $data = $this->stockService->getAllBatches();

    if ($criteria === 'critical') {
        $data = array_filter($data, function ($b) {
            $daysLeft = (strtotime($b['expiration_date']) - time()) / 86400;
            return $daysLeft <= 30;
        });
    }

    echo json_encode([
        "status" => 200,
        "data" => array_values($data)
    ]);
}
}