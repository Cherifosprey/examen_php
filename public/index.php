<?php
require_once dirname(__DIR__) . '/config/config.php';

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\UtilisateurController;
use App\Controllers\ClientController;
use App\Controllers\FournisseurController; 
use App\Controllers\CategorieController; 
use App\Controllers\ArticleConfectionController; 
use App\Controllers\ArticleVenteController; 
use App\Controllers\ProductionController; 
use App\Controllers\VenteController; 
use App\Controllers\ApprovisionnementController; 


$action = $_GET['action'] ?? 'login';

$id = $_GET['id'] ?? null;

$routes = [
    // Routes d'authentification
    'login' => [AuthController::class, 'login'],
    'logout' => [AuthController::class, 'logout'],

    // Route du tableau de bord
    'dashboard' => [DashboardController::class, 'index'],

    // Routes pour la gestion des utilisateurs
    'utilisateurs' => [UtilisateurController::class, 'list'],              
    'ajouterUtilisateur' => [UtilisateurController::class, 'create'],       
    'modifierUtilisateur' => [UtilisateurController::class, 'edit'],         
    'archiveUtilisateur' => [UtilisateurController::class, 'archive'],      
    'supprimerUtilisateur' => [UtilisateurController::class, 'delete'],     

    // Routes pour la gestion des clients
    'clients' => [ClientController::class, 'list'],                
    'ajouterClient' => [ClientController::class, 'create'],         
    'modifierClient' => [ClientController::class, 'edit'],          
    'archiveClient' => [ClientController::class, 'archive'],        
    'supprimerClient' => [ClientController::class, 'delete'],      

    // Routes pour la gestion des fournisseurs
    'fournisseurs' => [FournisseurController::class, 'list'],               
    'ajouterFournisseur' => [FournisseurController::class, 'create'],         
    'modifierFournisseur' => [FournisseurController::class, 'edit'],          
    'archiveFournisseur' => [FournisseurController::class, 'archive'],        
    'supprimerFournisseur' => [FournisseurController::class, 'delete'],      

    // Catégories <--- AJOUTEZ CES LIGNES POUR LES CATÉGORIES
    'categories' => [CategorieController::class, 'list'],
    'ajouterCategorie' => [CategorieController::class, 'create'],
    'modifierCategorie' => [CategorieController::class, 'edit'],
    'archiveCategorie' => [CategorieController::class, 'archive'],
    'supprimerCategorie' => [CategorieController::class, 'delete'],

    // Articles de Confection <--- AJOUTEZ CES LIGNES
    'articlesConfection' => [ArticleConfectionController::class, 'list'],
    'ajouterArticleConfection' => [ArticleConfectionController::class, 'createOrEdit'],
    'modifierArticleConfection' => [ArticleConfectionController::class, 'createOrEdit'],
    'archiveArticleConfection' => [ArticleConfectionController::class, 'archive'],
    'supprimerArticleConfection' => [ArticleConfectionController::class, 'delete'],

     // Articles de Vente <--- AJOUTEZ CES LIGNES
    'articlesVente' => [ArticleVenteController::class, 'list'],
    'ajouterArticleVente' => [ArticleVenteController::class, 'createOrEdit'],
    'modifierArticleVente' => [ArticleVenteController::class, 'createOrEdit'],
    'archiveArticleVente' => [ArticleVenteController::class, 'archive'],
    'supprimerArticleVente' => [ArticleVenteController::class, 'delete'],

    // Productions <--- AJOUTEZ CES LIGNES
    'productions' => [ProductionController::class, 'list'],
    'ajouterProduction' => [ProductionController::class, 'createOrEdit'],
    'modifierProduction' => [ProductionController::class, 'createOrEdit'],
    'supprimerProduction' => [ProductionController::class, 'delete'],

    // Ventes <--- AJOUTEZ CES LIGNES
    'ventes' => [VenteController::class, 'list'],
    'ajouterVente' => [VenteController::class, 'createOrEdit'],
    'modifierVente' => [VenteController::class, 'createOrEdit'],
    'supprimerVente' => [VenteController::class, 'delete'],


    // Approvisionnements <--- AJOUTEZ CES LIGNES
    'approvisionnements' => [ApprovisionnementController::class, 'list'],
    'ajouterApprovisionnement' => [ApprovisionnementController::class, 'createOrEdit'],
    'modifierApprovisionnement' => [ApprovisionnementController::class, 'createOrEdit'],
    'supprimerApprovisionnement' => [ApprovisionnementController::class, 'delete'],
];

if (array_key_exists($action, $routes)) {
    $controllerClass = $routes[$action][0];
    $methodName = $routes[$action][1];

    // Instancier le contrôleur.
    $controller = new $controllerClass();

    if (in_array($methodName, ['edit', 'archive', 'delete', 'view']) && $id !== null) {
        $controller->$methodName($id);
    } else {
        $controller->$methodName();
    }
} else {
    //  page 404
    header('Location: ' . BASE_URL . 'index.php?action=login');
    exit();
}