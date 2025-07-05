<?php
namespace App\Controllers;

use App\Services\AuthService;

class AuthController extends Controller {
    public function __construct() {
        parent::__construct(); 
    }

    public function login(): void {
        if ($this->authService->isLoggedIn()) {
            $this->redirect('dashboard');
        }

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->authService->login($email, $password);

            if ($user) {
                $this->redirect('dashboard');
            } else {
                $error = "Email ou mot de passe incorrect, ou utilisateur inactif.";
            }
        }

        $this->render('authentification/login', ['error' => $error, 'BASE_URL' => BASE_URL]);
    }

    public function logout(): void {
        $this->authService->logout();
        $this->redirect('login');
    }
}