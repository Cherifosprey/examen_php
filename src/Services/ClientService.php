<?php
namespace App\Services;

use App\Repositories\ClientRepository; 
use App\Models\Client; 

class ClientService {
    private $clientRepository;

    public function __construct() {
        $this->clientRepository = new ClientRepository();
    }

    public function getAllClients(): array {
        $clientsData = $this->clientRepository->findAll();
        $clients = [];
        foreach ($clientsData as $data) {
            $clients[] = (new Client())->fromArray($data);
        }
        return $clients;
    }

    public function getClientById(int $id): ?Client {
        $clientData = $this->clientRepository->findById($id);
        if ($clientData) {
            return (new Client())->fromArray($clientData);
        }
        return null;
    }

    public function createClient(array $data): ?Client {
        // Validation 
        if (empty($data['nom']) || empty($data['prenom']) || empty($data['email'])) {
            return null; 
        }

        $data['statut'] = $data['statut'] ?? 'actif';

        $clientId = $this->clientRepository->create($data);
        if ($clientId) {
            return $this->getClientById($clientId);
        }
        return null;
    }

    public function updateClient(int $id, array $data): bool {
        $existingClient = $this->clientRepository->findById($id);
        if (!$existingClient) {
            return false;
        }

        $mergedData = array_merge($existingClient, $data);

        return $this->clientRepository->update($id, $mergedData);
    }

    public function archiveClient(int $id): bool {
        return $this->clientRepository->update($id, ['statut' => 'archivé']);
    }

    public function deleteClient(int $id): bool {
        return $this->clientRepository->delete($id);
    }
    public function countAllClients(): int {
        return count($this->clientRepository->findAll());
    }
}