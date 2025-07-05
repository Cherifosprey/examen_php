<?php
namespace App\Controllers;

use App\Services\UtilisateurService;
use App\Models\Utilisateur; 

class UtilisateurController extends Controller {
    private $utilisateurService;

    public function __construct() {
        parent::__construct();
        $this->utilisateurService = new UtilisateurService();
    }

    public function list(): void {
        $this->enforceRole(['Gestionnaire']); 

        $utilisateurs = $this->utilisateurService->getAllUtilisateurs();
        $this->render('utilisateurs/liste', [
            'utilisateurs' => $utilisateurs,
            'title' => 'Liste des Utilisateurs'
        ]);
    }

    public function create(): void {
        $this->enforceRole(['Gestionnaire']);

        $errors = [];
        $formData = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = $_POST;

            if (empty($formData['nom'])) $errors['nom'] = "Le nom est requis.";
            if (empty($formData['prenom'])) $errors['prenom'] = "Le prénom est requis.";
            if (empty($formData['email'])) $errors['email'] = "L'email est requis.";
            if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = "Format d'email invalide.";
            if (empty($formData['mot_de_passe'])) $errors['mot_de_passe'] = "Le mot de passe est requis.";
            if (empty($formData['role'])) $errors['role'] = "Le rôle est requis.";

            if (empty($errors)) {
                $user = $this->utilisateurService->createUtilisateur($formData);
                if ($user) {
                    $this->redirect('utilisateurs', ['message' => 'Utilisateur ajouté avec succès !']);
                } else {
                    $errors['global'] = "Erreur lors de l'ajout de l'utilisateur. Veuillez réessayer.";
                }
            }
        }

        $this->render('utilisateurs/ajouter_modifier', [
            'title' => 'Ajouter un Utilisateur',
            'errors' => $errors,
            'formData' => $formData,
            'isEdit' => false 
        ]);
    }

    public function edit(int $id): void {
        $this->enforceRole(['Gestionnaire']);

        $user = $this->utilisateurService->getUtilisateurById($id);
        if (!$user) {
            $this->redirect('utilisateurs', ['error' => 'Utilisateur non trouvé.']);
        }

        $errors = [];
        $formData = $user->toArray(); 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = array_merge($formData, $_POST); 

            if (empty($formData['nom'])) $errors['nom'] = "Le nom est requis.";
            if (empty($formData['prenom'])) $errors['prenom'] = "Le prénom est requis.";
            if (empty($formData['email'])) $errors['email'] = "L'email est requis.";
            if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = "Format d'email invalide.";
            if (empty($formData['role'])) $errors['role'] = "Le rôle est requis.";

            if (empty($formData['mot_de_passe'])) {
                unset($formData['mot_de_passe']); 
            }

            if (empty($errors)) {
                $updated = $this->utilisateurService->updateUtilisateur($id, $formData);
                if ($updated) {
                    $this->redirect('utilisateurs', ['message' => 'Utilisateur mis à jour avec succès !']);
                } else {
                    $errors['global'] = "Erreur lors de la mise à jour de l'utilisateur. Veuillez réessayer.";
                }
            }
        }

        /*
        public function toArray(): array {
            return [
                'utilisateur_id' => $this->utilisateur_id,
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'email' => $this->email,
                'telephone_portable' => $this->telephone_portable,
                'adresse' => $this->adresse,
                'salaire' => $this->salaire,
                'photo' => $this->photo,
                'role' => $this->role,
                'date_creation' => $this->date_creation,
                'statut' => $this->statut,
            ];
        }
        */

        $this->render('utilisateurs/ajouter_modifier', [
            'title' => 'Modifier l\'Utilisateur',
            'errors' => $errors,
            'formData' => $formData,
            'isEdit' => true 
        ]);
    }

    public function archive(int $id): void {
        $this->enforceRole(['Gestionnaire']); 

        if ($this->utilisateurService->archiveUtilisateur($id)) {
            $this->redirect('utilisateurs', ['message' => 'Utilisateur archivé avec succès !']);
        } else {
            $this->redirect('utilisateurs', ['error' => 'Erreur lors de l\'archivage de l\'utilisateur.']);
        }
    }

    public function delete(int $id): void {
        $this->enforceRole(['Gestionnaire']); 

        if ($this->utilisateurService->deleteUtilisateur($id)) {
            $this->redirect('utilisateurs', ['message' => 'Utilisateur supprimé définitivement !']);
        } else {
            $this->redirect('utilisateurs', ['error' => 'Erreur lors de la suppression de l\'utilisateur.']);
        }
    }
}