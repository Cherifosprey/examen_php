<?php require_once ROOT_PATH . '/vues/includes/header.php'; ?>

<main class="content">
    <h2><?= htmlspecialchars($title) ?></h2>

    <?php if (!empty($errors['global'])): ?>
        <p class="error-message"><?= htmlspecialchars($errors['global']) ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <div>
            <label for="article_vente_id">Article de Vente Produit:</label>
            <select id="article_vente_id" name="article_vente_id" required>
                <option value="">Sélectionnez un article de vente</option>
                <?php foreach ($articlesVente as $article): ?>
                    <option value="<?= htmlspecialchars($article->getArticleVenteId()) ?>"
                        <?= (isset($formData['article_vente_id']) && $formData['article_vente_id'] == $article->getArticleVenteId()) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($article->getNomProduit() ?? 'Article Inconnu') ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($errors['article_vente_id'])): ?><span class="error-message"><?= htmlspecialchars($errors['article_vente_id']) ?></span><?php endif; ?>
        </div>
        <div>
            <label for="quantite_produite">Quantité Produite:</label>
            <input type="number" id="quantite_produite" name="quantite_produite" value="<?= htmlspecialchars($formData['quantite_produite'] ?? '') ?>" required min="1">
            <?php if (!empty($errors['quantite_produite'])): ?><span class="error-message"><?= htmlspecialchars($errors['quantite_produite']) ?></span><?php endif; ?>
        </div>
        <div>
            <label for="statut">Statut de la production:</label>
            <select id="statut" name="statut" required>
                <option value="en_cours" <?= ($formData['statut'] ?? 'en_cours') === 'en_cours' ? 'selected' : '' ?>>En Cours</option>
                <option value="terminee" <?= ($formData['statut'] ?? '') === 'terminee' ? 'selected' : '' ?>>Terminée</option>
                <option value="annulee" <?= ($formData['statut'] ?? '') === 'annulee' ? 'selected' : '' ?>>Annulée</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Mettre à jour' : 'Enregistrer' ?> la production</button>
        <a href="<?= BASE_URL ?>index.php?action=productions" class="btn btn-secondary">Annuler</a>
    </form>
</main>

<?php require_once ROOT_PATH . '/vues/includes/footer.php'; ?>