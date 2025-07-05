<?php
namespace App\Repositories;

use PDO;

class ProductionRepository extends BaseRepository {
    public function __construct() {
        parent::__construct('productions', 'production_id');
    }

       public function findAll(): array {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE statut = 'en_cours'"); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}