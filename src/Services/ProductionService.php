<?php
namespace App\Services;

use App\Repositories\ProductionRepository;
use App\Repositories\ArticleVenteRepository;
use App\Models\Production;
use App\Models\ArticleVente; 

class ProductionService {
    private $productionRepository;
    private $articleVenteRepository; 

    public function __construct() {
        $this->productionRepository = new ProductionRepository();
        $this->articleVenteRepository = new ArticleVenteRepository(); 
    }

    public function getAllProductions(): array {
        $productionsData = $this->productionRepository->findAll();
        $productions = [];
        foreach ($productionsData as $data) {
            $productions[] = (new Production())->fromArray($data);
        }
        return $productions;
    }

    public function getProductionById(int $id): ?Production {
        $productionData = $this->productionRepository->findById($id);
        if ($productionData) {
            return (new Production())->fromArray($productionData);
        }
        return null;
    }

    public function createProduction(array $data): ?Production {
        // Validation 
        if (empty($data['article_vente_id']) || empty($data['quantite_produite']) || !is_numeric($data['quantite_produite']) || $data['quantite_produite'] <= 0) {
            return null;
        }

        $data['utilisateur_id'] = $_SESSION['user_id'] ?? null; 
        $data['statut'] = $data['statut'] ?? 'en_cours';

        $productionId = $this->productionRepository->create($data);

        if ($productionId) {
            $articleVente = $this->articleVenteRepository->findById($data['article_vente_id']);
            if ($articleVente) {
                $nouvelleQuantiteStock = ($articleVente['quantite_stock'] ?? 0) + (int)$data['quantite_produite'];
                $this->articleVenteRepository->update($data['article_vente_id'], ['quantite_stock' => $nouvelleQuantiteStock]);
            }

            return $this->getProductionById($productionId);
        }
        return null;
    }

    public function updateProduction(int $id, array $data): bool {
        $existingProduction = $this->productionRepository->findById($id);
        if (!$existingProduction) {
            return false;
        }


        $mergedData = array_merge($existingProduction, $data);
        return $this->productionRepository->update($id, $mergedData);
    }

    public function deleteProduction(int $id): bool {
        return $this->productionRepository->delete($id);
    }

    public function getArticlesVenteForForm(): array {
        $articleVenteService = new ArticleVenteService(); 
        return $articleVenteService->getAllArticlesVente();
    }

    public function getArticlesVenteWithLowStock(int $threshold = 10): array {
        $articlesData = $this->articleVenteRepository->findAll(); 
        $lowStockArticles = [];
        foreach ($articlesData as $data) {
            if (($data['quantite_stock'] ?? 0) <= $threshold) {
                $lowStockArticles[] = (new ArticleVente())->fromArray($data);
            }
        }
        return $lowStockArticles;
    }

    public function countAllArticlesVente(): int {
        return count($this->articleVenteRepository->findAll());
    }
}