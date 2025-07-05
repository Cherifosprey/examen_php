<?php
namespace App\Repositories;

use PDO;

class VenteRepository extends BaseRepository {
    public function __construct() {
        parent::__construct('ventes', 'vente_id');
    }

    public function findAll(): array {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE statut = 'paye'"); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}