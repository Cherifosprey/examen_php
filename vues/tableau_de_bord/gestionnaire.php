<?php require_once ROOT_PATH . '/vues/includes/header.php'; ?>
<?php // sidebar.php est déjà inclus dans header.php ?>

<main class="content">
    <h2><i class="fas fa-chart-line"></i> Tableau de Bord Gestionnaire</h2>
    <p>Bienvenue, <?= htmlspecialchars($user_prenom) ?> !</p>
    <p>Ceci est le tableau de bord du gestionnaire. Vous avez un aperçu complet de toutes les opérations.</p>

    <div class="dashboard-metrics">
        <div class="metric-card orange">
            <h3>Ventes Totales</h3>
            <p class="value">5 250 000 XOF</p>
        </div>
        <div class="metric-card green">
            <h3>Articles en Stock</h3>
            <p class="value">1 200 unités</p>
        </div>
        <div class="metric-card blue">
            <h3>Nouvelles Productions</h3>
            <p class="value">50 unités cette semaine</p>
        </div>
    </div>
    </main>

<?php require_once ROOT_PATH . '/vues/includes/footer.php'; ?>