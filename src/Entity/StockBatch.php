<?php
namespace PharmaFEFO\Entity;

class StockBatch {
    private int $productId;
    private string $lotNumber;
    private int $quantity;
    private string $expirationDate;
    private string $status;

    public function __construct(
        int $productId,
        string $lotNumber,
        int $quantity,
        string $expirationDate,
        string $status = 'OK'
    ) {
        $this->productId = $productId;
        $this->lotNumber = $lotNumber;
        $this->quantity = $quantity;
        $this->expirationDate = $expirationDate;
        $this->status = $status;
    }

    // Getters
    public function getProductId(): int { return $this->productId; }
    public function getLotNumber(): string { return $this->lotNumber; }
    public function getQuantity(): int { return $this->quantity; }
    public function getExpirationDate(): string { return $this->expirationDate; }
    public function getStatus(): string { return $this->status; }

  
    public function setQuantity(int $quantity): void { $this->quantity = $quantity; }
    public function setStatus(string $status): void { $this->status = $status; }
}
