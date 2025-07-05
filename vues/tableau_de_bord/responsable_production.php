<?php require_once ROOT_PATH . '/vues/includes/header.php'; ?>
<?php // sidebar.php est déjà inclus dans header.php ?>
<main class="content">
    <h2><i class="fas fa-chart-line"></i> Tableau de Bord Responsable Production </h2>
    <p>Bienvenue, <?= htmlspecialchars($user_prenom) ?> !</p>
    <p>Ceci est le tableau de bord du Responsable Production.</p>

    <div class="dashboard-metrics">
        <div class="metric-card orange">
            <h3>Productions en Cours</h3>
            <p class="value">5 250 unités</p>
        </div>
        <div class="metric-card green">
            <h3>Articles de Vente Populairesk</h3>
            <p class="value">1 200 unités</p>
        </div>
    </div>
    </main>
<?php require_once ROOT_PATH . '/vues/includes/footer.php'; ?>

