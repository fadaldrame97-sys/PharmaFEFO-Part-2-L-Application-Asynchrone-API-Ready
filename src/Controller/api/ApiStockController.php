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
    }
}