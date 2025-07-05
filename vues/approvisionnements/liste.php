<?php require_once ROOT_PATH . '/vues/includes/header.php'; ?>

<main class="content">
    <h2><?= htmlspecialchars($title) ?></h2>

    <?php if (isset($_GET['message'])): ?>
        <p class="success-message"><?= htmlspecialchars($_GET['message']) ?></p>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <p class="error-message"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <a href="<?= BASE_URL ?>index.php?action=ajouterApprovisionnement" class="btn btn-primary" style="margin-bottom: 20px;">Enregistrer un nouvel approvisionnement</a>

    <?php if (!empty($approvisionnements)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID Appro.</th>
                    <th>Fournisseur</th>
                    <th>Article Confection</th>
                    <th>Quantité Achetée</th>
                    <th>Prix Unitaire Achat</th>
                    <th>Date Approvisionnement</th>
                    <th>Utilisateur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($approvisionnements as $approvisionnement): ?>
                    <tr>
                        <td><?= htmlspecialchars($approvisionnement->getApprovisionnementId() ?? '') ?></td>
                        <td><?= htmlspecialchars($approvisionnement->fournisseur_nom ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($approvisionnement->article_confection_nom ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($approvisionnement->getQuantiteAchetee() ?? '') ?></td>
                        <td><?= htmlspecialchars(number_format($approvisionnement->getPrixUnitaireAchat() ?? 0, 2) . ' F') ?></td>
                        <td><?= htmlspecialchars($approvisionnement->getDateApprovisionnement() ?? '') ?></td>
                        <td><?= htmlspecialchars($approvisionnement->utilisateur_nom ?? 'N/A') ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>index.php?action=modifierApprovisionnement&id=<?= $approvisionnement->getApprovisionnementId() ?>" class="btn btn-sm btn-warning">Modifier</a>
                            <a href="<?= BASE_URL ?>index.php?action=supprimerApprovisionnement&id=<?= $approvisionnement->getApprovisionnementId() ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir SUPPRIMER DÉFINITIVEMENT cet approvisionnement ? Cette action est irréversible et n\'annulera PAS l\'ajout au stock.');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun approvisionnement trouvé.</p>
    <?php endif; ?>
</main>

<?php require_once ROOT_PATH . '/vues/includes/footer.php'; ?>