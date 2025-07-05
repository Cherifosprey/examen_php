<?php require_once ROOT_PATH . '/vues/includes/header.php'; ?>
<?php // sidebar.php est déjà inclus dans header.php ?>
<main class="content">
    <h2><i class="fas fa-chart-line"></i> Tableau de Bord Responsable Stock </h2>
    <p>Bienvenue, <?= htmlspecialchars($user_prenom) ?> !</p>
    <p>Ceci est le tableau de bord du Responsable Stock</p>

    <div class="dashboard-metrics">
        <div class="metric-card orange">
            <h3>Articles en Alerte Stock</h3>
            <p class="value">tissus</p>
        </div>
        <div class="metric-card green">
            <h3>Dernier Approvisionnement</h3>
            <p class="value">Boutons</p>
        </div>
    </div>
</main>
<?php require_once ROOT_PATH . '/vues/includes/footer.php'; ?>

