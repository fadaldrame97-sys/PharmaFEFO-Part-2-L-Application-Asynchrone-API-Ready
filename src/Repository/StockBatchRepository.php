<?php
// src/Repository/StockBatchRepository.php
namespace PharmaFEFO\Repository;
use PharmaFEFO\Entity\StockBatch;


use Database;
use PDO;

class StockBatchRepository {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

   
    public function findAllFEFO(): array {
        $sql = "SELECT sb.*, p.name as product_name, p.code as product_code 
                FROM stock_batches sb
                JOIN products p ON sb.product_id = p.id
                ORDER BY sb.expiration_date ASC";
        
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function save(array $data): bool {
        $sql = "INSERT INTO stock_batches (product_id, lot_number, quantity, expiration_date, status) 
                VALUES (:product_id, :lot_number, :quantity, :expiration_date, :status)";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'product_id'      => $data['product_id'],
            'lot_number'      => $data['lot_number'],
            'quantity'        => $data['quantity'],
            'expiration_date' => $data['expiration_date'],
            'status'          => $data['status']
        ]);
    }

   
    public function getPriorityBatch(int $productId): ?array {
        $sql = "SELECT sb.*, p.name as product_name 
                FROM stock_batches sb
                JOIN products p ON sb.product_id = p.id
                WHERE sb.product_id = :product_id AND sb.quantity > 0 AND sb.status != 'EXPIRED'
                ORDER BY sb.expiration_date ASC 
                LIMIT 1";
                
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['product_id' => $productId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result ?: null;
    }
    
    
    public function getAllProducts(): array {
        $stmt = $this->pdo->query("SELECT * FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    public function markAsExpired(int $batchId): bool {
        $sql = "UPDATE stock_batches SET status = 'EXPIRED', quantity = 0 WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $batchId]);
    }

   
    public function getTotalPertesBoites(): int {
        $sql = "SELECT SUM(quantity) as total_perdu FROM stock_batches WHERE status = 'EXPIRED' OR expiration_date < CURDATE()";
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_perdu'] ? (int)$result['total_perdu'] : 0;
    }

    public function decreaseQuantity(int $batchId, int $qty): bool
{
    $sql = "UPDATE stock_batches
            SET quantity = quantity - :qty
            WHERE id = :id";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        'qty' => $qty,
        'id' => $batchId
    ]);
     }


     public function updateStatus(int $batchId, string $status): bool
{
    $sql = "UPDATE stock_batches
            SET status = :status
            WHERE id = :id";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        'status' => $status,
        'id' => $batchId
    ]);
}


public function insertBatch(array $data): array
{
    $sql = "INSERT INTO stock_batches (product_id, quantity, expiration_date, lot_number)
            VALUES (:product_id, :quantity, :expiration_date, :lot_number)";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($data);

    return [
        "id" => $this->pdo->lastInsertId(),
        "message" => "inserted"
    ];
}
  

}