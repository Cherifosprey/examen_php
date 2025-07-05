<?php
namespace App\Controllers;

use App\Services\ProductionService;
use App\Models\Production; 

class ProductionController extends Controller {
    private $productionService;

    public function __construct() {
        parent::__construct();
        $this->productionService = new ProductionService();
    }

    public function list(): void {
        $this->enforceRole(['Gestionnaire', 'Responsable Production']); 

        $productions = $this->productionService->getAllProductions();
        $this->render('productions/liste', [
            'productions' => $productions,
            'title' => 'Liste des Productions'
        ]);
    }

    public function createOrEdit(?int $id = null): void {
        $this->enforceRole(['Gestionnaire', 'Responsable Production']);

        $errors = [];
        $formData = [];
        $isEdit = false;
        $title = 'Enregistrer une nouvelle Production';

        if ($id) {
            $production = $this->productionService->getProductionById($id);
            if (!$production) {
                $this->redirect('productions', ['error' => 'Production non trouvée.']);
            }
            $formData = $production->toArray();
            $isEdit = true;
            $title = 'Modifier la Production';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = array_merge($formData, $_POST); 

            // Validation
            if (empty($formData['article_vente_id'])) $errors['article_vente_id'] = "L'article de vente est requis.";
            if (empty($formData['quantite_produite']) || !is_numeric($formData['quantite_produite']) || $formData['quantite_produite'] <= 0) {
                $errors['quantite_produite'] = "La quantité produite est requise et doit être un nombre positif.";
            }

            if (empty($errors)) {
                $success = false;
                if ($isEdit) {
                    $success = $this->productionService->updateProduction($id, $formData);
                } else {
                    $production = $this->productionService->createProduction($formData);
                    $success = ($production !== null);
                }

                if ($success) {
                    $this->redirect('productions', ['message' => 'Production ' . ($isEdit ? 'mise à jour' : 'enregistrée') . ' avec succès !']);
                } else {
                    $errors['global'] = "Erreur lors de la sauvegarde de la production. Veuillez réessayer.";
                }
            }
        }

        $articlesVente = $this->productionService->getArticlesVenteForForm();

        $this->render('productions/ajouter_modifier', [
            'title' => $title,
            'errors' => $errors,
            'formData' => $formData,
            'isEdit' => $isEdit,
            'articlesVente' => $articlesVente
        ]);
    }

    public function delete(int $id): void {
        $this->enforceRole(['Gestionnaire']);

        if ($this->productionService->deleteProduction($id)) {
            $this->redirect('productions', ['message' => 'Production supprimée avec succès !']);
        } else {
            $this->redirect('productions', ['error' => 'Erreur lors de la suppression de la production.']);
        }
    }
}