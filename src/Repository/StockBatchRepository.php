<?php
// src/Repository/StockBatchRepository.php
namespace PharmaFEFO\Repository;

use Database;
use PDO;

class StockBatchRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    /**
     * Épic 2 : Tri par FEFO exact (Expiration la plus proche en premier)
     */
    public function findAllFEFO(): array {
        $sql = "SELECT sb.*, p.name as product_name, p.code as product_code 
                FROM stock_batches sb
                JOIN products p ON sb.product_id = p.id
                ORDER BY sb.expiration_date ASC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function save(array $data): bool {
        $sql = "INSERT INTO stock_batches (product_id, lot_number, quantity, expiration_date, status) 
                VALUES (:product_id, :lot_number, :quantity, :expiration_date, :status)";
        
        $stmt = $this->db->prepare($sql);
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
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['product_id' => $productId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result ?: null;
    }
    
    
    public function getAllProducts(): array {
        $stmt = $this->db->query("SELECT * FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    public function markAsExpired(int $batchId): bool {
        $sql = "UPDATE stock_batches SET status = 'EXPIRED', quantity = 0 WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $batchId]);
    }

   
    public function getTotalPertesBoites(): int {
        $sql = "SELECT SUM(quantity) as total_perdu FROM stock_batches WHERE status = 'EXPIRED' OR expiration_date < CURDATE()";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_perdu'] ? (int)$result['total_perdu'] : 0;
    }
  

}