<?php
namespace PharmaFEFO\Controller\Api;

use PharmaFEFO\Service\StockService;

class ApiStockController
{
    private StockService $stockService;

    public function __construct()
    {
        $this->stockService = new StockService();
    }

    public function index():void {
        header('content-Type: application/json');

        $data=$this->stockService->getAllBatches();

        echo json_encode(["status"=>200,"data"=>$data]);
    }


    public function checkout(): void
    {
        header('Content-Type: application/json');

        $input = json_decode(file_get_contents("php://input"), true);

        $productId = $input['product_id'] ?? null;
    }
}