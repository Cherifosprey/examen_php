<?php
namespace App\Services;

use App\Repositories\UtilisateurRepository;
use App\Models\Utilisateur;

class UtilisateurService extends BaseService {
    private $utilisateurRepository;
    private $authService; // hacher

    public function __construct() {
        $this->utilisateurRepository = new UtilisateurRepository();
        $this->authService = new AuthService();
    }

    public function getAllUtilisateurs(): array {
        $utilisateursData = $this->utilisateurRepository->findAll();
        $utilisateurs = [];
        foreach ($utilisateursData as $data) {
            $utilisateurs[] = new Utilisateur(
                $data['utilisateur_id'],
                $data['nom'],
                $data['prenom'],
                $data['email'],
                $data['mot_de_passe'],
                $data['telephone_portable'],
                $data['adresse'],
                $data['salaire'],
                $data['photo'],
                $data['role'],
                $data['date_creation'],
                $data['statut']
            );
        }
        return $utilisateurs;
    }

    public function getUtilisateurById(int $id): ?Utilisateur {
        $userData = $this->utilisateurRepository->findById($id);
        if ($userData) {
            return new Utilisateur(
                $userData['utilisateur_id'],
                $userData['nom'],
                $userData['prenom'],
                $userData['email'],
                $userData['mot_de_passe'],
                $userData['telephone_portable'],
                $userData['adresse'],
                $userData['salaire'],
                $userData['photo'],
                $userData['role'],
                $userData['date_creation'],
                $userData['statut']
            );
        }
        return null;
    }

    public function createUtilisateur(array $data): ?Utilisateur {
        // Valider 
        if (empty($data['email']) || empty($data['mot_de_passe']) || empty($data['nom'])) {
            return null; 
        }

        // Hacher mot de passe 
        $data['mot_de_passe'] = $this->authService->hashPassword($data['mot_de_passe']);
        $data['date_creation'] = date('Y-m-d H:i:s'); 

        $id = $this->utilisateurRepository->create($data);
        if ($id) {
            return $this->getUtilisateurById($id);
        }
        return null;
    }

    public function updateUtilisateur(int $id, array $data): bool {
        if (isset($data['mot_de_passe']) && !empty($data['mot_de_passe'])) {
            $data['mot_de_passe'] = $this->authService->hashPassword($data['mot_de_passe']);
        }
        return $this->utilisateurRepository->update($id, $data);
    }

    public function archiveUtilisateur(int $id): bool {
        return $this->utilisateurRepository->archive($id);
    }

    public function deleteUtilisateur(int $id): bool {
        return $this->utilisateurRepository->delete($id);
    }

    public function checkEmailExists(string $email): bool {
        return $this->utilisateurRepository->findByEmail($email) !== null;
    }

    public function countAllUtilisateurs(): int {
        return count($this->utilisateurRepository->findAll());
    }
}