<aside class="sidebar">
    <div class="menu-section">
        <ul>
            <li>
                <a href="<?= BASE_URL ?>index.php?action=dashboard" class="<?= (isset($_GET['action']) && $_GET['action'] == 'dashboard') ? 'active' : '' ?>">
                    <i class="fas fa-tachometer-alt"></i> Tableau de Bord
                </a>
            </li>
            <li>
                <a href="<?= BASE_URL ?>index.php?action=monProfil" class="<?= (isset($_GET['action']) && $_GET['action'] == 'monProfil') ? 'active' : '' ?>">
                    <i class="fas fa-user"></i> Mon Profil
                </a>
            </li>
        </ul>
    </div>

    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Gestionnaire'): ?>
    <div class="menu-section">
        <div class="menu-section-title">Administration</div>
        <ul>
            <li>
                <a href="<?= BASE_URL ?>index.php?action=utilisateurs" class="<?= (isset($_GET['action']) && $_GET['action'] == 'utilisateurs') ? 'active' : '' ?>">
                    <i class="fas fa-users"></i> Gestion des Employés
                </a>
            </li>
            <li>
                <a href="<?= BASE_URL ?>index.php?action=categories" class="<?= (isset($_GET['action']) && $_GET['action'] == 'categories') ? 'active' : '' ?>">
                    <i class="fas fa-tags"></i> Gestion des Catégories
                </a>
            </li>
            <li>
                <a href="<?= BASE_URL ?>index.php?action=rapports" class="<?= (isset($_GET['action']) && $_GET['action'] == 'rapports') ? 'active' : '' ?>">
                    <i class="fas fa-chart-line"></i> Rapports et Statistiques
                </a>
            </li>
        </ul>
    </div>
    <?php endif; ?>

    <div class="menu-section">
        <div class="menu-section-title">Opérations Générales</div>
        <ul>
            <?php if (isset($_SESSION['user_role']) && ($_SESSION['user_role'] === 'Gestionnaire' || $_SESSION['user_role'] === 'Responsable Stock')): ?>
            <li>
                <a href="<?= BASE_URL ?>index.php?action=approvisionnements" class="<?= (isset($_GET['action']) && $_GET['action'] == 'approvisionnements') ? 'active' : '' ?>">
                    <i class="fas fa-truck-loading"></i> Gestion du Stock
                </a>
            </li>
            <li>
                <a href="<?= BASE_URL ?>index.php?action=articlesConfection" class="<?= (isset($_GET['action']) && $_GET['action'] == 'articlesConfection') ? 'active' : '' ?>">
                    <i class="fas fa-boxes"></i> Articles de Confection
                </a>
            </li>
            <li>
                <a href="<?= BASE_URL ?>index.php?action=fournisseurs" class="<?= (isset($_GET['action']) && $_GET['action'] == 'fournisseurs') ? 'active' : '' ?>">
                    <i class="fas fa-truck"></i> Gestion des Fournisseurs
                </a>
            </li>
            <?php endif; ?>
            <?php if (isset($_SESSION['user_role']) && ($_SESSION['user_role'] === 'Gestionnaire' || $_SESSION['user_role'] === 'Responsable Production')): ?>
            <li>
                <a href="<?= BASE_URL ?>index.php?action=productions" class="<?= (isset($_GET['action']) && $_GET['action'] == 'productions') ? 'active' : '' ?>">
                    <i class="fas fa-tshirt"></i> Gestion de la Production
                </a>
            </li>
            <li>
                <a href="<?= BASE_URL ?>index.php?action=articlesVente" class="<?= (isset($_GET['action']) && $_GET['action'] == 'articlesVente') ? 'active' : '' ?>">
                    <i class="fas fa-box-open"></i> Articles de Vente
                </a>
            </li>
            <?php endif; ?>
            <?php if (isset($_SESSION['user_role']) && ($_SESSION['user_role'] === 'Gestionnaire' || $_SESSION['user_role'] === 'Vendeur')): ?>
            <li>
                <a href="<?= BASE_URL ?>index.php?action=ventes" class="<?= (isset($_GET['action']) && $_GET['action'] == 'ventes') ? 'active' : '' ?>">
                    <i class="fas fa-shopping-cart"></i> Gestion des Ventes
                </a>
            </li>
            <li>
                <a href="<?= BASE_URL ?>index.php?action=clients" class="<?= (isset($_GET['action']) && $_GET['action'] == 'clients') ? 'active' : '' ?>">
                    <i class="fas fa-users-line"></i> Gestion des Clients
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </div>

    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Gestionnaire'): ?>
    <div class="menu-section">
        <div class="menu-section-title">Paramètres</div>
        <ul>
            <li>
                <a href="<?= BASE_URL ?>index.php?action=parametres" class="<?= (isset($_GET['action']) && $_GET['action'] == 'parametres') ? 'active' : '' ?>">
                    <i class="fas fa-cog"></i> Paramètres Système
                </a>
            </li>
        </ul>
    </div>
    <?php endif; ?>
</aside>