<?php
namespace App\Services;

use App\Repositories\FournisseurRepository;
use App\Models\Fournisseur;

class FournisseurService {
    private $fournisseurRepository;

    public function __construct() {
        $this->fournisseurRepository = new FournisseurRepository();
    }

    public function getAllFournisseurs(): array {
        $fournisseursData = $this->fournisseurRepository->findAll();
        $fournisseurs = [];
        foreach ($fournisseursData as $data) {
            $fournisseurs[] = (new Fournisseur())->fromArray($data);
        }
        return $fournisseurs;
    }

    public function getFournisseurById(int $id): ?Fournisseur {
        $fournisseurData = $this->fournisseurRepository->findById($id);
        if ($fournisseurData) {
            return (new Fournisseur())->fromArray($fournisseurData);
        }
        return null;
    }

    public function createFournisseur(array $data): ?Fournisseur {
        // Validation
        if (empty($data['nom_entreprise']) || empty($data['email'])) {
            return null;
        }

        $data['statut'] = $data['statut'] ?? 'actif'; 

        $fournisseurId = $this->fournisseurRepository->create($data);
        if ($fournisseurId) {
            return $this->getFournisseurById($fournisseurId);
        }
        return null;
    }

    public function updateFournisseur(int $id, array $data): bool {
        $existingFournisseur = $this->fournisseurRepository->findById($id);
        if (!$existingFournisseur) {
            return false;
        }
        $mergedData = array_merge($existingFournisseur, $data);
        return $this->fournisseurRepository->update($id, $mergedData);
    }

    public function archiveFournisseur(int $id): bool {
        return $this->fournisseurRepository->update($id, ['statut' => 'archivé']);
    }

    public function deleteFournisseur(int $id): bool {
        return $this->fournisseurRepository->delete($id);
    }

    public function countAllFournisseurs(): int {
        return count($this->fournisseurRepository->findAll());
    }
}