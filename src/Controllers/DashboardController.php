<?php
namespace App\Controllers;

class DashboardController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index(): void {
        $this->enforceAuth(); 

        $userRole = $_SESSION['user_role'] ?? 'Invité';
        $viewPath = '';

        switch ($userRole) {
            case 'Gestionnaire':
                $viewPath = 'tableau_de_bord/gestionnaire';
                break;
            case 'Responsable Stock':
                $viewPath = 'tableau_de_bord/responsable_stock';
                break;
            case 'Responsable Production':
                $viewPath = 'tableau_de_bord/responsable_production';
                break;
            case 'Vendeur':
                $viewPath = 'tableau_de_bord/vendeur';
                break;
            default:
                $this->redirect('login');
                break;
        }

        if ($viewPath) {
            $this->render($viewPath, [
                'user_prenom' => $_SESSION['user_prenom'] ?? '',
                'user_nom' => $_SESSION['user_nom'] ?? '',
                'user_role' => $userRole
            ]);
        }
    }
}