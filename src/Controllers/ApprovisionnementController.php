<?php
namespace App\Controllers;

use App\Services\ApprovisionnementService;
use App\Models\Approvisionnement; 

class ApprovisionnementController extends Controller {
    private $approvisionnementService;

    public function __construct() {
        parent::__construct();
        $this->approvisionnementService = new ApprovisionnementService();
    }

    public function list(): void {
        $this->enforceRole(['Gestionnaire', 'Responsable Stock']); 

        $approvisionnements = $this->approvisionnementService->getApprovisionnementsWithRelatedNames();
        $this->render('approvisionnements/liste', [
            'approvisionnements' => $approvisionnements,
            'title' => 'Liste des Approvisionnements'
        ]);
    }

    public function createOrEdit(?int $id = null): void {
        $this->enforceRole(['Gestionnaire', 'Responsable Stock']);

        $errors = [];
        $formData = [];
        $isEdit = false;
        $title = 'Enregistrer un nouvel Approvisionnement';

        if ($id) {
            $approvisionnement = $this->approvisionnementService->getApprovisionnementById($id);
            if (!$approvisionnement) {
                $this->redirect('approvisionnements', ['error' => 'Approvisionnement non trouvé.']);
            }
            $formData = $approvisionnement->toArray();
            $isEdit = true;
            $title = 'Modifier l\'Approvisionnement';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = array_merge($formData, $_POST); 

            if (empty($formData['fournisseur_id'])) $errors['fournisseur_id'] = "Le fournisseur est requis.";
            if (empty($formData['article_confection_id'])) $errors['article_confection_id'] = "L'article de confection est requis.";
            if (empty($formData['quantite_achetee']) || !is_numeric($formData['quantite_achetee']) || $formData['quantite_achetee'] <= 0) {
                $errors['quantite_achetee'] = "La quantité achetée est requise et doit être un nombre positif.";
            }
            if (empty($formData['prix_unitaire_achat']) || !is_numeric($formData['prix_unitaire_achat']) || $formData['prix_unitaire_achat'] <= 0) {
                $errors['prix_unitaire_achat'] = "Le prix unitaire est requis et doit être un nombre positif.";
            }

            if (empty($errors)) {
                $success = false;
                if ($isEdit) {
                    $success = $this->approvisionnementService->updateApprovisionnement($id, $formData);
                } else {
                    $approvisionnement = $this->approvisionnementService->createApprovisionnement($formData);
                    $success = ($approvisionnement !== null);
                }

                if ($success) {
                    $this->redirect('approvisionnements', ['message' => 'Approvisionnement ' . ($isEdit ? 'mis à jour' : 'enregistré') . ' avec succès !']);
                } else {
                    $errors['global'] = "Erreur lors de la sauvegarde de l'approvisionnement. Veuillez réessayer.";
                }
            }
        }

        $fournisseurs = $this->approvisionnementService->getFournisseursForForm();
        $articlesConfection = $this->approvisionnementService->getArticlesConfectionForForm();

        $this->render('approvisionnements/ajouter_modifier', [
            'title' => $title,
            'errors' => $errors,
            'formData' => $formData,
            'isEdit' => $isEdit,
            'fournisseurs' => $fournisseurs,
            'articlesConfection' => $articlesConfection
        ]);
    }

    public function delete(int $id): void {
        $this->enforceRole(['Gestionnaire']); 

        if ($this->approvisionnementService->deleteApprovisionnement($id)) {
            $this->redirect('approvisionnements', ['message' => 'Approvisionnement supprimé avec succès !']);
        } else {
            $this->redirect('approvisionnements', ['error' => 'Erreur lors de la suppression de l\'approvisionnement.']);
        }
    }
}