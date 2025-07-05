<?php
namespace App\Repositories;

use PDO;

class ApprovisionnementRepository extends BaseRepository {
    public function __construct() {
        parent::__construct('approvisionnements', 'approvisionnement_id');
    }

       public function findAll(): array {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE statut = 'reçu'"); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

