<?php
namespace PharmaFEFO\Controller\Api;

use PharmaFEFO\Service\StockService;

class ApiDashboardController{
    private StockService $stockService;

    public function __construct()
    {
         $this->stockService= new StockService();
    }
    public function index():void {
        header('content-Type: application/json');

        $critic=$this->stockService->getCriticalBatches();
        $loss=$this->stockService->getTotalLoss();
        
        json_encode(["CriticalBatches"=>count($critic), "TotalLoss"=>$loss]);

    }
}