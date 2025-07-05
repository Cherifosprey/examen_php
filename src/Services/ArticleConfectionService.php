<?php
namespace App\Services;

use App\Repositories\ArticleConfectionRepository;
use App\Models\ArticleConfection;
use App\Services\FournisseurService; 
use App\Services\CategorieService;  

class ArticleConfectionService {
    private $articleConfectionRepository;
    private $fournisseurService;
    private $categorieService;

    public function __construct() {
        $this->articleConfectionRepository = new ArticleConfectionRepository();
        $this->fournisseurService = new FournisseurService();
        $this->categorieService = new CategorieService();
    }

    public function getAllArticlesConfection(): array {
        $articlesData = $this->articleConfectionRepository->findAll();
        $articles = [];
        foreach ($articlesData as $data) {
            $articles[] = (new ArticleConfection())->fromArray($data);
        }
        return $articles;
    }

    public function getArticleConfectionById(int $id): ?ArticleConfection {
        $articleData = $this->articleConfectionRepository->findById($id);
        if ($articleData) {
            return (new ArticleConfection())->fromArray($articleData);
        }
        return null;
    }

    public function createArticleConfection(array $data): ?ArticleConfection {
        // Validation 
        if (empty($data['nom_article']) || empty($data['prix_unitaire_achat']) || empty($data['unite_mesure']) || empty($data['quantite_stock'])) {
            return null;
        }

        $data['statut'] = $data['statut'] ?? 'actif';

        $articleId = $this->articleConfectionRepository->create($data);
        if ($articleId) {
            return $this->getArticleConfectionById($articleId);
        }
        return null;
    }

    public function updateArticleConfection(int $id, array $data): bool {
        $existingArticle = $this->articleConfectionRepository->findById($id);
        if (!$existingArticle) {
            return false;
        }
        $mergedData = array_merge($existingArticle, $data);
        return $this->articleConfectionRepository->update($id, $mergedData);
    }

    public function archiveArticleConfection(int $id): bool {
        return $this->articleConfectionRepository->update($id, ['statut' => 'inactif']); 
    }

    public function deleteArticleConfection(int $id): bool {
        return $this->articleConfectionRepository->delete($id);
    }

    public function getFournisseursForForm(): array {
        return $this->fournisseurService->getAllFournisseurs();
    }

    public function getCategoriesForForm(): array {
        return $this->categorieService->getAllCategories();
    }

    public function getArticlesConfectionWithLowStock(int $threshold = 10): array {
        $articlesData = $this->articleConfectionRepository->findAll(); 
        foreach ($articlesData as $data) {
            if (($data['quantite_stock'] ?? 0) <= $threshold) {
                $lowStockArticles[] = (new ArticleConfection())->fromArray($data);
            }
        }
        return $lowStockArticles;
    }

    public function countAllArticlesConfection(): int {
        return count($this->articleConfectionRepository->findAll());
    }
}