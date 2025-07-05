<?php require_once ROOT_PATH . '/vues/includes/header.php'; ?>
<?php // sidebar.php est déjà inclus dans header.php ?>
<main class="content">
    <h2><i class="fas fa-chart-line"></i> Tableau de Bord Vendeur </h2>
    <p>Bienvenue, <?= htmlspecialchars($user_prenom) ?> !</p>
    <p>Ceci est le tableau de bord du Vendeur</p>

    <div class="dashboard-metrics">
        <div class="metric-card orange">
            <h3>Ventes Aujourd'hui</h3>
            <p class="value">500 000 F</p>
        </div>
        <div class="metric-card green">
            <h3>Nouveaux Clients ce mois</h3>
            <p class="value">12 clients</p>
        </div>
    </div>
    </main>
<?php require_once ROOT_PATH . '/vues/includes/footer.php'; ?>

