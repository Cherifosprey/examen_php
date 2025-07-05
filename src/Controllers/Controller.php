<?php
namespace App\Controllers;

use App\Services\AuthService;

abstract class Controller {
    protected $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    protected function render(string $path, array $data = []): void {
        extract($data);
        require_once ROOT_PATH . '/vues/' . $path . '.php';
    }

    protected function redirect(string $action, array $params = []): void {
        $queryString = http_build_query($params);
        $url = BASE_URL . 'index.php?action=' . $action . ($queryString ? '&' . $queryString : '');
        header('Location: ' . $url);
        exit();
    }

    protected function enforceAuth(): void {
        if (!$this->authService->isLoggedIn()) {
            $this->redirect('login');
        }
    }

    protected function enforceRole($requiredRole): void {
        $this->enforceAuth(); 
        if (!$this->authService->hasRole($requiredRole)) {
            $this->redirect('dashboard');
        }
    }
}