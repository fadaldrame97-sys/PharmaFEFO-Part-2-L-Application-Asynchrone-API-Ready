<?php
namespace PharmaFEFO\Repository;
use PharmaFEFO\Entity\StockBatch;


class StockRepository {
    private \PDO $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findByProductId(int $productId): ?StockBatch {
        $stmt = $this->pdo->prepare("SELECT * FROM stock_batches WHERE product_id = ?");
        $stmt->execute([$productId]);
        $row = $stmt->fetch();

        if (!$row) return null;

        return new StockBatch(
            $row['product_id'],
            $row['lot_number'],
            $row['quantity'],
            $row['expiration_date'],
            $row['status']
        );
    }

    public function updateQuantity(int $productId, int $newQuantity): void {
        $stmt = $this->pdo->prepare("UPDATE stock_batches SET quantity = ? WHERE product_id = ?");
        $stmt->execute([$newQuantity, $productId]);
    }
}
