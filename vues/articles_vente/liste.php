<?php require_once ROOT_PATH . '/vues/includes/header.php'; ?>

<main class="content">
    <h2><?= htmlspecialchars($title) ?></h2>

    <?php if (isset($_GET['message'])): ?>
        <p class="success-message"><?= htmlspecialchars($_GET['message']) ?></p>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <p class="error-message"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <a href="<?= BASE_URL ?>index.php?action=ajouterArticleVente" class="btn btn-primary" style="margin-bottom: 20px;">Ajouter un nouvel article de vente</a>

    <?php if (!empty($articles)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom Produit</th>
                    <th>Description</th>
                    <th>Prix Vente</th>
                    <th>Catégorie ID</th>
                    <th>Stock</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?= htmlspecialchars($article->getArticleVenteId() ?? '') ?></td>
                        <td><?= htmlspecialchars($article->getNomProduit() ?? '') ?></td>
                        <td><?= htmlspecialchars($article->getDescription() ?? '') ?></td>
                        <td><?= htmlspecialchars($article->getPrixVente() ?? '') ?></td>
                        <td><?= htmlspecialchars($article->getCategorieId() ?? '') ?></td>
                        <td><?= htmlspecialchars($article->getQuantiteStock() ?? '') ?></td>
                        <td><?= htmlspecialchars($article->getStatut() ?? '') ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>index.php?action=modifierArticleVente&id=<?= $article->getArticleVenteId() ?>" class="btn btn-sm btn-warning">Modifier</a>
                            <a href="<?= BASE_URL ?>index.php?action=archiveArticleVente&id=<?= $article->getArticleVenteId() ?>" class="btn btn-sm btn-info" onclick="return confirm('Êtes-vous sûr de vouloir archiver cet article ?');">Archiver</a>
                            <a href="<?= BASE_URL ?>index.php?action=supprimerArticleVente&id=<?= $article->getArticleVenteId() ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir SUPPRIMER DÉFINITIVEMENT cet article ? Cette action est irréversible.');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun article de vente trouvé.</p>
    <?php endif; ?>
</main>

<?php require_once ROOT_PATH . '/vues/includes/footer.php'; ?>