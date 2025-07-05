<?php
namespace App\Services;

use App\Repositories\ApprovisionnementRepository;
use App\Repositories\ArticleConfectionRepository; 
use App\Models\Approvisionnement;
use App\Models\ArticleConfection; 
use App\Services\FournisseurService; 
use App\Services\UtilisateurService; 

class ApprovisionnementService {
    private $approvisionnementRepository;
    private $articleConfectionRepository;
    private $fournisseurService;
    private $utilisateurService;

    public function __construct() {
        $this->approvisionnementRepository = new ApprovisionnementRepository();
        $this->articleConfectionRepository = new ArticleConfectionRepository();
        $this->fournisseurService = new FournisseurService();
        $this->utilisateurService = new UtilisateurService();
    }

    public function getAllApprovisionnements(): array {
        $approvisionnementsData = $this->approvisionnementRepository->findAll();
        $approvisionnements = [];
        foreach ($approvisionnementsData as $data) {
            $approvisionnements[] = (new Approvisionnement())->fromArray($data);
        }
        return $approvisionnements;
    }

    public function getApprovisionnementById(int $id): ?Approvisionnement {
        $approvisionnementData = $this->approvisionnementRepository->findById($id);
        if ($approvisionnementData) {
            return (new Approvisionnement())->fromArray($approvisionnementData);
        }
        return null;
    }


    public function createApprovisionnement(array $data): ?Approvisionnement {
        // Validation 
        if (empty($data['fournisseur_id']) || empty($data['article_confection_id']) || empty($data['quantite_achetee']) || !is_numeric($data['quantite_achetee']) || $data['quantite_achetee'] <= 0 || empty($data['prix_unitaire_achat']) || !is_numeric($data['prix_unitaire_achat']) || $data['prix_unitaire_achat'] <= 0) {
            return null; 
        }

        $data['utilisateur_id'] = $_SESSION['user_id'] ?? null; 

        $approvisionnementId = $this->approvisionnementRepository->create($data);

        if ($approvisionnementId) {
            $articleConfection = $this->articleConfectionRepository->findById($data['article_confection_id']);
            if ($articleConfection) {
                $nouvelleQuantiteStock = ($articleConfection['quantite_stock'] ?? 0) + (int)$data['quantite_achetee'];
                $this->articleConfectionRepository->update($data['article_confection_id'], ['quantite_stock' => $nouvelleQuantiteStock]);
            }

            return $this->getApprovisionnementById($approvisionnementId);
        }
        return null;
    }

    public function updateApprovisionnement(int $id, array $data): bool {
        $existingApprovisionnement = $this->approvisionnementRepository->findById($id);
        if (!$existingApprovisionnement) {
            return false;
        }

        $mergedData = array_merge($existingApprovisionnement, $data);
        return $this->approvisionnementRepository->update($id, $mergedData);
    }


    public function deleteApprovisionnement(int $id): bool {
        return $this->approvisionnementRepository->delete($id);
    }

    public function getFournisseursForForm(): array {
        return $this->fournisseurService->getAllFournisseurs();
    }

    public function getArticlesConfectionForForm(): array {
        $articlesData = $this->articleConfectionRepository->findAll();
        $articles = [];
        foreach ($articlesData as $data) {
            $articles[] = (new ArticleConfection())->fromArray($data);
        }
        return $articles;
    }

    public function getApprovisionnementsWithRelatedNames(): array {
        $approvisionnements = $this->getAllApprovisionnements();
        $fournisseurs = $this->fournisseurService->getAllFournisseurs();
        $articlesConfection = $this->getArticlesConfectionForForm(); 
        $utilisateurs = $this->utilisateurService->getAllUtilisateurs();

        $fournisseurMap = [];
        foreach ($fournisseurs as $fournisseur) {
            $fournisseurMap[$fournisseur->getFournisseurId()] = $fournisseur->getNomEntreprise();
        }

        $articleConfectionMap = [];
        foreach ($articlesConfection as $article) {
            $articleConfectionMap[$article->getArticleConfectionId()] = $article->getNomArticle();
        }

        $utilisateurMap = [];
        foreach ($utilisateurs as $utilisateur) {
            $utilisateurMap[$utilisateur->getUtilisateurId()] = $utilisateur->getNomComplet(); 
        }

        foreach ($approvisionnements as $app) {
            $app->fournisseur_nom = $fournisseurMap[$app->getFournisseurId()] ?? 'Fournisseur Inconnu';
            $app->article_confection_nom = $articleConfectionMap[$app->getArticleConfectionId()] ?? 'Article Inconnu';
            $app->utilisateur_nom = $utilisateurMap[$app->getUtilisateurId()] ?? 'Utilisateur Inconnu';
        }
        return $approvisionnements;
    }
}