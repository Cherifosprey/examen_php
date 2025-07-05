<?php
namespace App\Controllers;

use App\Services\ClientService;
use App\Models\Client; 

class ClientController extends Controller {
    private $clientService;

    public function __construct() {
        parent::__construct();
        $this->clientService = new ClientService();
    }
    public function list(): void {
        $this->enforceRole(['Gestionnaire', 'Vendeur']); 

        $clients = $this->clientService->getAllClients();
        $this->render('clients/liste', [
            'clients' => $clients,
            'title' => 'Liste des Clients'
        ]);
    }

    public function create(): void {
        $this->enforceRole(['Gestionnaire', 'Vendeur']);

        $errors = [];
        $formData = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = $_POST;

            if (empty($formData['nom'])) $errors['nom'] = "Le nom est requis.";
            if (empty($formData['prenom'])) $errors['prenom'] = "Le prénom est requis.";
            if (empty($formData['email'])) $errors['email'] = "L'email est requis.";
            if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = "Format d'email invalide.";

            if (empty($errors)) {
                $client = $this->clientService->createClient($formData);
                if ($client) {
                    $this->redirect('clients', ['message' => 'Client ajouté avec succès !']);
                } else {
                    $errors['global'] = "Erreur lors de l'ajout du client. Veuillez réessayer.";
                }
            }
        }

        $this->render('clients/ajouter_modifier', [
            'title' => 'Ajouter un Client',
            'errors' => $errors,
            'formData' => $formData,
            'isEdit' => false
        ]);
    }

    public function edit(int $id): void {
        $this->enforceRole(['Gestionnaire', 'Vendeur']);

        $client = $this->clientService->getClientById($id);
        if (!$client) {
            $this->redirect('clients', ['error' => 'Client non trouvé.']);
        }

        $errors = [];
        $formData = $client->toArray(); 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = array_merge($formData, $_POST);

            if (empty($formData['nom'])) $errors['nom'] = "Le nom est requis.";
            if (empty($formData['prenom'])) $errors['prenom'] = "Le prénom est requis.";
            if (empty($formData['email'])) $errors['email'] = "L'email est requis.";
            if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = "Format d'email invalide.";

            if (empty($errors)) {
                $updated = $this->clientService->updateClient($id, $formData);
                if ($updated) {
                    $this->redirect('clients', ['message' => 'Client mis à jour avec succès !']);
                } else {
                    $errors['global'] = "Erreur lors de la mise à jour du client. Veuillez réessayer.";
                }
            }
        }

        $this->render('clients/ajouter_modifier', [
            'title' => 'Modifier le Client',
            'errors' => $errors,
            'formData' => $formData,
            'isEdit' => true
        ]);
    }

    public function archive(int $id): void {
        $this->enforceRole(['Gestionnaire', 'Vendeur']);

        if ($this->clientService->archiveClient($id)) {
            $this->redirect('clients', ['message' => 'Client archivé avec succès !']);
        } else {
            $this->redirect('clients', ['error' => 'Erreur lors de l\'archivage du client.']);
        }
    }

    public function delete(int $id): void {
        $this->enforceRole(['Gestionnaire']); 

        if ($this->clientService->deleteClient($id)) {
            $this->redirect('clients', ['message' => 'Client supprimé définitivement !']);
        } else {
            $this->redirect('clients', ['error' => 'Erreur lors de la suppression du client.']);
        }
    }
}