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
}