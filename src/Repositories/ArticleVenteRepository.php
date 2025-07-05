<?php
namespace App\Repositories;

use PDO;

class ArticleVenteRepository extends BaseRepository {
    public function __construct() {
        parent::__construct('articles_vente', 'article_vente_id');
    }

    public function findAll(): array {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE statut = 'disponible'"); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

