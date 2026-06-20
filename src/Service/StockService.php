<?php

namespace PharmaFEFO\Service;

use PharmaFEFO\Repository\StockBatchRepository;

class StockService
{
    private StockBatchRepository $repository;

    public function __construct()
    {
        $this->repository = new StockBatchRepository();
    }

    
    public function getAllBatches(): array
    {
        return $this->repository->findAllFEFO();
    }

    
    public function getPriorityBatch(int $productId): ?array
    {
        return $this->repository->getPriorityBatch($productId);
    }

   
    public function checkout(int $productId, int $qty = 1): array
    {
        $batch = $this->repository->getPriorityBatch($productId);

        var_dump($batch['id']);
        
        if (!$batch) {
            return [
                "success" => false,
                "message" => "Aucun lot disponible"
            ];
        }

        if ($batch['quantity'] < $qty) {
            return [
                "success" => false,
                "message" => "Stock insuffisant"
            ];
        }

        $this->repository->decreaseQuantity($batch['id'], $qty);

        // si stock = 0 → optionnel status
        if (($batch['quantity'] - $qty) <= 0) {
            $this->repository->updateStatus($batch['id'], "EMPTY");
        }

        return [
            "success" => true,
            "message" => "Produit délivré (FEFO appliqué)",
            "batch_id" => $batch['id']
        ];
    }

   
    public function expireBatch(int $batchId): array
    {
        $this->repository->markAsExpired($batchId);

        return [
            "success" => true,
            "message" => "Lot marqué comme EXPIRED"
        ];
    }

    public function getCriticalBatches(): array
    {
        $batches = $this->repository->findAllFEFO();

        return array_filter($batches, function ($batch) {
            $daysLeft = (strtotime($batch['expiration_date']) - time()) / 86400;
            return $daysLeft <= 30 && $batch['status'] !== 'EXPIRED';
        });
    }

   
    public function getTotalLoss(): int
    {
        return $this->repository->getTotalPertesBoites();
    }


    public function addBatch(array $data): array
{
    return $this->repository->insertBatch([
        'product_id' => $data['product_id'],
        'quantity' => $data['quantity'],
        'expiration_date' => $data['expiration_date'],
        'lot_number' => $data['lot_number'] ?? uniqid('LOT-')
    ]);
}
}