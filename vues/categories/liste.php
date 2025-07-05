<?php require_once ROOT_PATH . '/vues/includes/header.php'; ?>

<main class="content">
    <h2><?= htmlspecialchars($title) ?></h2>

    <?php if (isset($_GET['message'])): ?>
        <p class="success-message"><?= htmlspecialchars($_GET['message']) ?></p>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <p class="error-message"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <a href="<?= BASE_URL ?>index.php?action=ajouterCategorie" class="btn btn-primary" style="margin-bottom: 20px;">Ajouter une nouvelle catégorie</a>

    <?php if (!empty($categories)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom Catégorie</th>
                    <th>Description</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $categorie): ?>
                    <tr>
                        <td><?= htmlspecialchars($categorie->getCategorieId() ?? '') ?></td>
                        <td><?= htmlspecialchars($categorie->getLibelle() ?? '') ?></td>
                        <td><?= htmlspecialchars($categorie->getDescription() ?? '') ?></td>
                        <td><?= htmlspecialchars($categorie->getStatut() ?? '') ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>index.php?action=modifierCategorie&id=<?= $categorie->getCategorieId() ?>" class="btn btn-sm btn-warning">Modifier</a>
                            <a href="<?= BASE_URL ?>index.php?action=archiveCategorie&id=<?= $categorie->getCategorieId() ?>" class="btn btn-sm btn-info" onclick="return confirm('Êtes-vous sûr de vouloir archiver cette catégorie ?');">Archiver</a>
                            <a href="<?= BASE_URL ?>index.php?action=supprimerCategorie&id=<?= $categorie->getCategorieId() ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir SUPPRIMER DÉFINITIVEMENT cette catégorie ? Cette action est irréversible.');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucune catégorie trouvée.</p>
    <?php endif; ?>
</main>

<?php require_once ROOT_PATH . '/vues/includes/footer.php'; ?>