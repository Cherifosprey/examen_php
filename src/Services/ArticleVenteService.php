<?php
namespace App\Services;

use App\Repositories\ArticleVenteRepository;
use App\Models\ArticleVente;
use App\Services\CategorieService;

class ArticleVenteService extends BaseService {
    private $articleVenteRepository;
    private $categorieService;
    
    

    public function __construct() {
        $this->articleVenteRepository = new ArticleVenteRepository();
        $this->categorieService = new CategorieService();
    }

    public function getAllArticlesVente(): array {
        $articlesData = $this->articleVenteRepository->findAll();
        $articles = [];
        foreach ($articlesData as $data) {
            $articles[] = (new ArticleVente())->fromArray($data);
        }
        return $articles;
    }

    public function getCategoriesForForm(): array {
        return $this->categorieService->getAllCategories();
    }

    public function getArticleVenteById(int $id): ?ArticleVente {
        $articleData = $this->articleVenteRepository->findById($id);
        if ($articleData) {
            return (new ArticleVente())->fromArray($articleData);
        }
        return null;
    }
   

    public function createArticleVente(array $data): ?ArticleVente {
        if (empty($data['nom_produit']) || empty($data['prix_vente'])) {
            return null; 
        }
        $data['date_creation'] = date('Y-m-d H:i:s');

        $id = $this->articleVenteRepository->create($data);
        if ($id) {
            return $this->getArticleVenteById($id);
        }
        return null;
    }

    public function updateArticleVente(int $id, array $data): bool {
        return $this->articleVenteRepository->update($id, $data);
    }

    public function archiveArticleVente(int $id): bool {
        return $this->articleVenteRepository->archive($id);
    }

    public function deleteArticleVente(int $id): bool {
        return $this->articleVenteRepository->delete($id);
    }
}