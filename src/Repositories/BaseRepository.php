<?php
namespace App\Repositories;

use PDO;

abstract class BaseRepository {
    protected $db;
    protected $table;
    protected $idColumn;

    public function __construct(string $table, string $idColumn = 'id') {
        $this->db = ConnexionBD::getInstance()->getConnexion();
        $this->table = $table;
        $this->idColumn = $idColumn;
    }

    public function findAll(): array {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE statut = 'actif'"); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findAllWithStatus(bool $includeArchived = false): array {
        $sql = "SELECT * FROM {$this->table}";
        if (!$includeArchived) {
            $sql .= " WHERE statut = 'actif'";
        }
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$this->idColumn} = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function create(array $data): int {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);

        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool {
        $setClauses = [];
        foreach ($data as $key => $value) {
            $setClauses[] = "{$key} = :{$key}";
        }
        $setClause = implode(', ', $setClauses);

        $sql = "UPDATE {$this->table} SET {$setClause} WHERE {$this->idColumn} = :id";
        $stmt = $this->db->prepare($sql);

        $data[':id'] = $id; 
        return $stmt->execute($data);
    }

    public function archive(int $id): bool {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET statut = 'archivé' WHERE {$this->idColumn} = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function reactivate(int $id): bool {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET statut = 'actif' WHERE {$this->idColumn} = :id");
        return $stmt->execute([':id' => $id]);
    }


    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE {$this->idColumn} = :id");
        return $stmt->execute([':id' => $id]);
    }
}