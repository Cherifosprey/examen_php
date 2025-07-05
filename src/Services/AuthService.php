<?php
namespace App\Services;

use App\Repositories\UtilisateurRepository;
use App\Models\Utilisateur;

class AuthService {
    private $utilisateurRepository;

    public function __construct() {
        $this->utilisateurRepository = new UtilisateurRepository();
    }


    public function login(string $email, string $password): ?Utilisateur {
        $userData = $this->utilisateurRepository->findByEmail($email);

        if ($userData && $userData['statut'] === 'actif') {
            if (password_verify($password, $userData['mot_de_passe'])) {
                $user = new Utilisateur(
                    $userData['utilisateur_id'],
                    $userData['nom'],
                    $userData['prenom'],
                    $userData['email'],
                    $userData['mot_de_passe'], // haché
                    $userData['telephone_portable'],
                    $userData['adresse'],
                    $userData['salaire'],
                    $userData['photo'],
                    $userData['role'],
                    $userData['date_creation'],
                    $userData['statut']
                );

                $_SESSION['user_id'] = $user->getUtilisateurId();
                $_SESSION['user_nom'] = $user->getNom();
                $_SESSION['user_prenom'] = $user->getPrenom();
                $_SESSION['user_email'] = $user->getEmail();
                $_SESSION['user_role'] = $user->getRole();
                $_SESSION['logged_in'] = true;

                return $user;
            }
        }
        return null; 
    }

    public function logout(): void {
        session_unset();
        session_destroy();
    }

    public function isLoggedIn(): bool {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    public function hasRole($requiredRole): bool {
        if (!$this->isLoggedIn()) {
            return false;
        }

        $userRole = $_SESSION['user_role'] ?? null;

        if (is_array($requiredRole)) {
            return in_array($userRole, $requiredRole);
        }

        return $userRole === $requiredRole;
    }

    public function hashPassword(string $password): string {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}