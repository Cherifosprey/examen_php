<?php
namespace App\Controllers;

use App\Services\ArticleConfectionService;
use App\Models\ArticleConfection;

class ArticleConfectionController extends Controller {
    private $articleConfectionService;

    public function __construct() {
        parent::__construct();
        $this->articleConfectionService = new ArticleConfectionService();
    }

    public function list(): void {
        $this->enforceRole(['Gestionnaire', 'Responsable Stock']); 

        $articles = $this->articleConfectionService->getAllArticlesConfection();
        $this->render('articles_confection/liste', [
            'articles' => $articles,
            'title' => 'Liste des Articles de Confection'
        ]);
    }

    public function createOrEdit(?int $id = null): void {
        $this->enforceRole(['Gestionnaire', 'Responsable Stock']);

        $errors = [];
        $formData = [];
        $isEdit = false;
        $title = 'Ajouter un Article de Confection';

        if ($id) {
            $article = $this->articleConfectionService->getArticleConfectionById($id);
            if (!$article) {
                $this->redirect('articlesConfection', ['error' => 'Article de confection non trouvé.']);
            }
            $formData = $article->toArray();
            $isEdit = true;
            $title = 'Modifier l\'Article de Confection';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = array_merge($formData, $_POST); 

            // Validation
            if (empty($formData['nom_article'])) $errors['nom_article'] = "Le nom de l'article est requis.";
            if (empty($formData['prix_unitaire_achat']) || !is_numeric($formData['prix_unitaire_achat'])) {
                $errors['prix_unitaire_achat'] = "Le prix d'achat unitaire est requis et doit être un nombre.";
            }
            if (empty($formData['unite_mesure'])) $errors['unite_mesure'] = "L'unité de mesure est requise.";
            if (empty($formData['quantite_stock']) || !is_numeric($formData['quantite_stock'])) {
                $errors['quantite_stock'] = "La quantité en stock est requise et doit être un nombre entier.";
            }
            if (empty($formData['fournisseur_id'])) $errors['fournisseur_id'] = "Le fournisseur est requis.";
            if (empty($formData['categorie_id'])) $errors['categorie_id'] = "La catégorie est requise.";


            if (empty($errors)) {
                $success = false;
                if ($isEdit) {
                    $success = $this->articleConfectionService->updateArticleConfection($id, $formData);
                } else {
                    $article = $this->articleConfectionService->createArticleConfection($formData);
                    $success = ($article !== null);
                }

                if ($success) {
                    $this->redirect('articlesConfection', ['message' => 'Article de confection ' . ($isEdit ? 'mis à jour' : 'ajouté') . ' avec succès !']);
                } else {
                    $errors['global'] = "Erreur lors de la sauvegarde de l'article. Veuillez réessayer.";
                }
            }
        }

        $fournisseurs = $this->articleConfectionService->getFournisseursForForm();
        $categories = $this->articleConfectionService->getCategoriesForForm();


        $this->render('articles_confection/ajouter_modifier', [
            'title' => $title,
            'errors' => $errors,
            'formData' => $formData,
            'isEdit' => $isEdit,
            'fournisseurs' => $fournisseurs,
            'categories' => $categories
        ]);
    }

    public function archive(int $id): void {
        $this->enforceRole(['Gestionnaire', 'Responsable Stock']);

        if ($this->articleConfectionService->archiveArticleConfection($id)) {
            $this->redirect('articlesConfection', ['message' => 'Article de confection archivé avec succès !']);
        } else {
            $this->redirect('articlesConfection', ['error' => 'Erreur lors de l\'archivage de l\'article.']);
        }
    }

    public function delete(int $id): void {
        $this->enforceRole(['Gestionnaire']); 

        if ($this->articleConfectionService->deleteArticleConfection($id)) {
            $this->redirect('articlesConfection', ['message' => 'Article de confection supprimé définitivement !']);
        } else {
            $this->redirect('articlesConfection', ['error' => 'Erreur lors de la suppression de l\'article.']);
        }
    }
}