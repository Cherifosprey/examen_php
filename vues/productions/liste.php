<?php require_once ROOT_PATH . '/vues/includes/header.php'; ?>

<main class="content">
    <h2><?= htmlspecialchars($title) ?></h2>

    <?php if (isset($_GET['message'])): ?>
        <p class="success-message"><?= htmlspecialchars($_GET['message']) ?></p>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <p class="error-message"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <a href="<?= BASE_URL ?>index.php?action=ajouterProduction" class="btn btn-primary" style="margin-bottom: 20px;">Enregistrer une nouvelle production</a>

    <?php if (!empty($productions)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID Production</th>
                    <th>Article Vente ID</th>
                    <th>Quantité Produite</th>
                    <th>Date Production</th>
                    <th>Utilisateur ID</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productions as $production): ?>
                    <tr>
                        <td><?= htmlspecialchars($production->getProductionId() ?? '') ?></td>
                        <td><?= htmlspecialchars($production->getArticleVenteId() ?? '') ?></td>
                        <td><?= htmlspecialchars($production->getQuantiteProduite() ?? '') ?></td>
                        <td><?= htmlspecialchars($production->getDateProduction() ?? '') ?></td>
                        <td><?= htmlspecialchars($production->getUtilisateurId() ?? '') ?></td>
                        <td><?= htmlspecialchars($production->getStatut() ?? '') ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>index.php?action=modifierProduction&id=<?= $production->getProductionId() ?>" class="btn btn-sm btn-warning">Modifier</a>
                            <a href="<?= BASE_URL ?>index.php?action=supprimerProduction&id=<?= $production->getProductionId() ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir SUPPRIMER DÉFINITIVEMENT cette production ? Cette action est irréversible et n\'annulera PAS l\'ajout au stock.');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucune production trouvée.</p>
    <?php endif; ?>
</main>

<?php require_once ROOT_PATH . '/vues/includes/footer.php'; ?>