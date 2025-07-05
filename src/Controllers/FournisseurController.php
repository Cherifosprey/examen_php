<?php
namespace App\Controllers;

use App\Services\FournisseurService;
use App\Models\Fournisseur;

class FournisseurController extends Controller {
    private $fournisseurService;

    public function __construct() {
        parent::__construct();
        $this->fournisseurService = new FournisseurService();
    }

    public function list(): void {
        $this->enforceRole(['Gestionnaire', 'Responsable Stock']); 

        $fournisseurs = $this->fournisseurService->getAllFournisseurs();
        $this->render('fournisseurs/liste', [
            'fournisseurs' => $fournisseurs,
            'title' => 'Liste des Fournisseurs'
        ]);
    }
    public function create(): void {
        $this->enforceRole(['Gestionnaire', 'Responsable Stock']);

        $errors = [];
        $formData = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = $_POST;

            if (empty($formData['nom_entreprise'])) $errors['nom_entreprise'] = "Le nom de l'entreprise est requis.";
            if (empty($formData['email'])) $errors['email'] = "L'email est requis.";
            if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = "Format d'email invalide.";

            if (empty($errors)) {
                $fournisseur = $this->fournisseurService->createFournisseur($formData);
                if ($fournisseur) {
                    $this->redirect('fournisseurs', ['message' => 'Fournisseur ajouté avec succès !']);
                } else {
                    $errors['global'] = "Erreur lors de l'ajout du fournisseur. Veuillez réessayer.";
                }
            }
        }

        $this->render('fournisseurs/ajouter_modifier', [
            'title' => 'Ajouter un Fournisseur',
            'errors' => $errors,
            'formData' => $formData,
            'isEdit' => false
        ]);
    }

    public function edit(int $id): void {
        $this->enforceRole(['Gestionnaire', 'Responsable Stock']);

        $fournisseur = $this->fournisseurService->getFournisseurById($id);
        if (!$fournisseur) {
            $this->redirect('fournisseurs', ['error' => 'Fournisseur non trouvé.']);
        }

        $errors = [];
        $formData = $fournisseur->toArray();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = array_merge($formData, $_POST);

            if (empty($formData['nom_entreprise'])) $errors['nom_entreprise'] = "Le nom de l'entreprise est requis.";
            if (empty($formData['email'])) $errors['email'] = "L'email est requis.";
            if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = "Format d'email invalide.";

            if (empty($errors)) {
                $updated = $this->fournisseurService->updateFournisseur($id, $formData);
                if ($updated) {
                    $this->redirect('fournisseurs', ['message' => 'Fournisseur mis à jour avec succès !']);
                } else {
                    $errors['global'] = "Erreur lors de la mise à jour du fournisseur. Veuillez réessayer.";
                }
            }
        }

        $this->render('fournisseurs/ajouter_modifier', [
            'title' => 'Modifier le Fournisseur',
            'errors' => $errors,
            'formData' => $formData,
            'isEdit' => true
        ]);
    }

    public function archive(int $id): void {
        $this->enforceRole(['Gestionnaire', 'Responsable Stock']);

        if ($this->fournisseurService->archiveFournisseur($id)) {
            $this->redirect('fournisseurs', ['message' => 'Fournisseur archivé avec succès !']);
        } else {
            $this->redirect('fournisseurs', ['error' => 'Erreur lors de l\'archivage du fournisseur.']);
        }
    }

    public function delete(int $id): void {
        $this->enforceRole(['Gestionnaire']); 

        if ($this->fournisseurService->deleteFournisseur($id)) {
            $this->redirect('fournisseurs', ['message' => 'Fournisseur supprimé définitivement !']);
        } else {
            $this->redirect('fournisseurs', ['error' => 'Erreur lors de la suppression du fournisseur.']);
        }
    }
}