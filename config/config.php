<?php

// Configuration BD
define('BD_HOTE', 'localhost');
define('BD_NOM', 'atelier_couture_db');
define('BD_UTILISATEUR', 'root'); 
define('BD_MOT_DE_PASSE', ''); 

define('BASE_URL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']));
define('ROOT_PATH', dirname(__DIR__));

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

define('DB_HOST', 'localhost'); 
define('DB_NAME', 'atelier_couture_db');
define('DB_USER', 'root'); 
define('DB_PASSWORD', '');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

spl_autoload_register(function ($class) {
    // Convertit le namespace en chemin de fichier
    $prefix = 'App\\';
    $base_dir = ROOT_PATH . '/src/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

?>