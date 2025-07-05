<?php
namespace App\Controllers;

use App\Services\CategorieService;
use App\Models\Categorie;

class CategorieController extends Controller {
    private $categorieService;

    public function __construct() {
        parent::__construct();
        $this->categorieService = new CategorieService();
    }

    public function list(): void {
        $this->enforceRole(['Gestionnaire']); 

        $categories = $this->categorieService->getAllCategories();
        $this->render('categories/liste', [
            'categories' => $categories,
            'title' => 'Liste des Catégories'
        ]);
    }

    public function create(): void {
        $this->enforceRole(['Gestionnaire']);

        $errors = [];
        $formData = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = $_POST;

            if (empty($formData['libelle'])) $errors['libelle'] = "Le nom de la catégorie est requis."; 
            if (empty($errors)) {
                $categorie = $this->categorieService->createCategorie($formData);
                if ($categorie) {
                    $this->redirect('categories', ['message' => 'Catégorie ajoutée avec succès !']);
                } else {
                    $errors['global'] = "Erreur lors de l'ajout de la catégorie. Veuillez réessayer.";
                }
            }
        }

        $this->render('categories/ajouter_modifier', [
            'title' => 'Ajouter une Catégorie',
            'errors' => $errors,
            'formData' => $formData,
            'isEdit' => false
        ]);
    }

    public function edit(int $id): void {
        $this->enforceRole(['Gestionnaire']);

        $categorie = $this->categorieService->getCategorieById($id);
        if (!$categorie) {
            $this->redirect('categories', ['error' => 'Catégorie non trouvée.']);
        }

        $errors = [];
        $formData = $categorie->toArray();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = array_merge($formData, $_POST);

            if (empty($formData['nom_categorie'])) $errors['nom_categorie'] = "Le nom de la catégorie est requis.";

            if (empty($errors)) {
                $updated = $this->categorieService->updateCategorie($id, $formData);
                if ($updated) {
                    $this->redirect('categories', ['message' => 'Catégorie mise à jour avec succès !']);
                } else {
                    $errors['global'] = "Erreur lors de la mise à jour de la catégorie. Veuillez réessayer.";
                }
            }
        }

        $this->render('categories/ajouter_modifier', [
            'title' => 'Modifier la Catégorie',
            'errors' => $errors,
            'formData' => $formData,
            'isEdit' => true
        ]);
    }

    public function archive(int $id): void {
        $this->enforceRole(['Gestionnaire']);

        if ($this->categorieService->archiveCategorie($id)) {
            $this->redirect('categories', ['message' => 'Catégorie archivée avec succès !']);
        } else {
            $this->redirect('categories', ['error' => 'Erreur lors de l\'archivage de la catégorie.']);
        }
    }

    public function delete(int $id): void {
        $this->enforceRole(['Gestionnaire']);

        if ($this->categorieService->deleteCategorie($id)) {
            $this->redirect('categories', ['message' => 'Catégorie supprimée définitivement !']);
        } else {
            $this->redirect('categories', ['error' => 'Erreur lors de la suppression de la catégorie.']);
        }
    }
}