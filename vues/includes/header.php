<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atelier Couture - <?= htmlspecialchars($title ?? 'Accueil') ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header">
        <a href="<?= BASE_URL ?>index.php?action=dashboard" class="logo">Atelier Couture</a>
        <div class="user-info">
            <span>Bonjour, <?= htmlspecialchars($_SESSION['user_prenom'] ?? 'Invité') ?>, (<?= htmlspecialchars($_SESSION['user_role'] ?? '') ?>)</span>
            <a href="<?= BASE_URL ?>index.php?action=logout" class="logout-btn">Déconnexion</a>
        </div>
    </header>

    <div class="container-fluid">
        <?php require_once ROOT_PATH . '/vues/includes/sidebar.php'; ?>