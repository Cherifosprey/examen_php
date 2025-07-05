<?php
namespace App\Controllers;

use App\Services\VenteService;
use App\Models\Vente; 

class VenteController extends Controller {
    private $venteService;

    public function __construct() {
        parent::__construct();
        $this->venteService = new VenteService();
    }

    public function list(): void {
        $this->enforceRole(['Gestionnaire', 'Vendeur']);

        $ventes = $this->venteService->getVentesWithRelatedNames(); 
        $this->render('ventes/liste', [
            'ventes' => $ventes,
            'title' => 'Liste des Ventes'
        ]);
    }

    public function createOrEdit(?int $id = null): void {
        $this->enforceRole(['Gestionnaire', 'Vendeur']);

        $errors = [];
        $formData = [];
        $isEdit = false;
        $title = 'Enregistrer une nouvelle Vente';

        if ($id) {
            $vente = $this->venteService->getVenteById($id);
            if (!$vente) {
                $this->redirect('ventes', ['error' => 'Vente non trouvée.']);
            }
            $formData = $vente->toArray(); 
            if (isset($formData['details_produits_vendus']) && is_string($formData['details_produits_vendus'])) {
                $formData['details_produits_vendus'] = json_decode($formData['details_produits_vendus'], true);
            }
            $isEdit = true;
            $title = 'Modifier la Vente';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($isEdit) {
                $dataToUpdate = [
                    'client_id' => $_POST['client_id'] ?? null,
                    'statut_paiement' => $_POST['statut_paiement'] ?? null,
                    'mode_paiement' => $_POST['mode_paiement'] ?? null
                ];
            } else {
                $dataToProcess = $_POST;
                // Ex: articles[0][id], articles[0][quantite]
                $processedArticles = [];
                if (isset($dataToProcess['articles']) && is_array($dataToProcess['articles'])) {
                    foreach ($dataToProcess['articles'] as $articleData) {
                        if (!empty($articleData['article_id']) && !empty($articleData['quantite'])) {
                            $processedArticles[] = [
                                'article_vente_id' => (int)$articleData['article_id'],
                                'quantite_vendue' => (int)$articleData['quantite']
                            ];
                        }
                    }
                }
                $dataToProcess['articles'] = $processedArticles; 

                // Validation 
                if (empty($dataToProcess['client_id'])) $errors['client_id'] = "Le client est requis.";
                if (empty($dataToProcess['articles'])) $errors['articles'] = "Au moins un article doit être sélectionné.";
                if (!isset($dataToProcess['statut_paiement'])) $errors['statut_paiement'] = "Le statut de paiement est requis.";
            }


            if (empty($errors)) {
                $success = false;
                if ($isEdit) {
                    $success = $this->venteService->updateVente($id, $dataToUpdate);
                } else {
                    $vente = $this->venteService->createVente($dataToProcess);
                    if (!$vente) {
                         $errors['global'] = "Erreur lors de la création de la vente ou stock insuffisant.";
                    }
                    $success = ($vente !== null);
                }

                if ($success) {
                    $this->redirect('ventes', ['message' => 'Vente ' . ($isEdit ? 'mise à jour' : 'enregistrée') . ' avec succès !']);
                } else {
                    if (empty($errors['global'])) { 
                        $errors['global'] = "Erreur lors de la sauvegarde de la vente. Veuillez réessayer.";
                    }
                }
            }
             $formData = array_merge($formData, $_POST);
             if (isset($formData['articles']) && is_array($formData['articles'])) {
                 $reformattedArticles = [];
                 foreach ($formData['articles'] as $art) {
                     $reformattedArticles[] = [
                         'article_vente_id' => $art['article_id'],
                         'quantite_vendue' => $art['quantite']
                     ];
                 }
                 $formData['details_produits_vendus'] = $reformattedArticles;
             }
        }

        $clients = $this->venteService->getClientsForForm();
        $articlesVente = $this->venteService->getArticlesVenteForForm();

        $this->render('ventes/ajouter_modifier', [
            'title' => $title,
            'errors' => $errors,
            'formData' => $formData,
            'isEdit' => $isEdit,
            'clients' => $clients,
            'articlesVente' => $articlesVente 
        ]);
    }

    public function delete(int $id): void {
        $this->enforceRole(['Gestionnaire']);

        if ($this->venteService->deleteVente($id)) {
            $this->redirect('ventes', ['message' => 'Vente supprimée définitivement !']);
        } else {
            $this->redirect('ventes', ['error' => 'Erreur lors de la suppression de la vente.']);
        }
    }
}