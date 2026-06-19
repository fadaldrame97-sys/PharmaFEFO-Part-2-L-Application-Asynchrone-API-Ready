<?php
namespace PharmaFEFO\Controller\Api;

use PharmaFEFO\Service\StockService;

class ApiDashboardController{
    private StockService $stockService;

    public function __construct()
    {
         $this->stockService= new StockService();
    }
}