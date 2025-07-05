<?php
namespace App\Repositories;


class UtilisateurRepository extends BaseRepository {
    public function __construct() {
        parent::__construct('utilisateurs', 'utilisateur_id');
    }

    public function findByEmail(string $email): ?array {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result ?: null;
    }
}