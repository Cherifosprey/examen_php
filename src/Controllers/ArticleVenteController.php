<?php
namespace App\Controllers;

use App\Services\ArticleVenteService;
use App\Models\ArticleVente;

class ArticleVenteController extends Controller {
    private $articleVenteService;

    public function __construct() {
        parent::__construct();
        $this->articleVenteService = new ArticleVenteService();
    }

    public function list(): void {
        $this->enforceRole(['Gestionnaire', 'Vendeur', 'Responsable Production']); 

        $articles = $this->articleVenteService->getAllArticlesVente();
        $this->render('articles_vente/liste', [
            'articles' => $articles,
            'title' => 'Liste des Articles de Vente'
        ]);
    }

    public function createOrEdit(?int $id = null): void {
        $this->enforceRole(['Gestionnaire', 'Responsable Production']); 

        $errors = [];
        $formData = [];
        $isEdit = false;
        $title = 'Ajouter un Article de Vente';

        if ($id) {
            $article = $this->articleVenteService->getArticleVenteById($id);
            if (!$article) {
                $this->redirect('articlesVente', ['error' => 'Article de vente non trouvé.']);
            }
            $formData = $article->toArray();
            $isEdit = true;
            $title = 'Modifier l\'Article de Vente';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = array_merge($formData, $_POST); 

            // Validation 
            if (empty($formData['nom_produit'])) $errors['nom_produit'] = "Le nom du produit est requis.";
            if (empty($formData['prix_vente']) || !is_numeric($formData['prix_vente']) || $formData['prix_vente'] <= 0) {
                $errors['prix_vente'] = "Le prix de vente est requis et doit être un nombre positif.";
            }
            if (empty($formData['categorie_id'])) $errors['categorie_id'] = "La catégorie est requise.";
            if (!isset($formData['quantite_stock']) || !is_numeric($formData['quantite_stock']) || $formData['quantite_stock'] < 0) {
                 $errors['quantite_stock'] = "La quantité en stock est requise et doit être un nombre entier positif ou nul.";
            }


            if (empty($errors)) {
                $success = false;
                if ($isEdit) {
                    $success = $this->articleVenteService->updateArticleVente($id, $formData);
                } else {
                    $article = $this->articleVenteService->createArticleVente($formData);
                    $success = $article !== null;
                }

                if ($success) {
                    $this->redirect('articlesVente', ['message' => 'Article de vente ' . ($isEdit ? 'mis à jour' : 'ajouté') . ' avec succès !']);
                } else {
                    $errors['global'] = "Erreur lors de la sauvegarde de l'article. Veuillez réessayer.";
                }
            }
        }

        $categories = $this->articleVenteService->getCategoriesForForm();


        $this->render('articles_vente/ajouter_modifier', [
            'title' => $title,
            'errors' => $errors,
            'formData' => $formData,
            'isEdit' => $isEdit,
            'categories' => $categories
        ]);
    }

    public function archive(int $id): void {
        $this->enforceRole(['Gestionnaire', 'Responsable Production']);

        if ($this->articleVenteService->archiveArticleVente($id)) {
            $this->redirect('articlesVente', ['message' => 'Article de vente archivé avec succès !']);
        } else {
            $this->redirect('articlesVente', ['error' => 'Erreur lors de l\'archivage de l\'article.']);
        }
    }

    public function delete(int $id): void {
        $this->enforceRole(['Gestionnaire']); 

        if ($this->articleVenteService->deleteArticleVente($id)) {
            $this->redirect('articlesVente', ['message' => 'Article de vente supprimé définitivement !']);
        } else {
            $this->redirect('articlesVente', ['error' => 'Erreur lors de la suppression de l\'article.']);
        }
    }
}