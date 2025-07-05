<?php
namespace App\Services;

use App\Repositories\CategorieRepository;
use App\Models\Categorie;

class CategorieService {
    private $categorieRepository;

    public function __construct() {
        $this->categorieRepository = new CategorieRepository();
    }

    public function getAllCategories(): array {
        $categoriesData = $this->categorieRepository->findAll();
        $categories = [];
        foreach ($categoriesData as $data) {
            $categories[] = (new Categorie())->fromArray($data);
        }
        return $categories;
    }

    public function getCategorieById(int $id): ?Categorie {
        $categorieData = $this->categorieRepository->findById($id);
        if ($categorieData) {
            return (new Categorie())->fromArray($categorieData);
        }
        return null;
    }

    public function createCategorie(array $data): ?Categorie {
        if (empty($data['libelle'])) {
            return null;
        }

        $data['statut'] = $data['statut'] ?? 'actif'; 

        $categorieId = $this->categorieRepository->create($data);
        if ($categorieId) {
            return $this->getCategorieById($categorieId);
        }
        return null;
    }

    public function updateCategorie(int $id, array $data): bool {
        $existingCategorie = $this->categorieRepository->findById($id);
        if (!$existingCategorie) {
            return false;
        }
        $mergedData = array_merge($existingCategorie, $data);
        return $this->categorieRepository->update($id, $mergedData);
    }

    public function archiveCategorie(int $id): bool {
        return $this->categorieRepository->update($id, ['statut' => 'archivé']);
    }

    public function deleteCategorie(int $id): bool {
        return $this->categorieRepository->delete($id);
    }
}