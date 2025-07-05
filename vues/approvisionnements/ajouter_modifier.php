<?php require_once ROOT_PATH . '/vues/includes/header.php'; ?>

<main class="content">
    <h2><?= htmlspecialchars($title) ?></h2>

    <?php if (!empty($errors['global'])): ?>
        <p class="error-message"><?= htmlspecialchars($errors['global']) ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <div>
            <label for="fournisseur_id">Fournisseur:</label>
            <select id="fournisseur_id" name="fournisseur_id" required>
                <option value="">Sélectionnez un fournisseur</option>
                <?php foreach ($fournisseurs as $fournisseur): ?>
                    <option value="<?= htmlspecialchars($fournisseur->getFournisseurId()) ?>"
                        <?= (isset($formData['fournisseur_id']) && $formData['fournisseur_id'] == $fournisseur->getFournisseurId()) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($fournisseur->getNomEntreprise()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($errors['fournisseur_id'])): ?><span class="error-message"><?= htmlspecialchars($errors['fournisseur_id']) ?></span><?php endif; ?>
        </div>
        <div>
            <label for="article_confection_id">Article de Confection (Matière Première):</label>
            <select id="article_confection_id" name="article_confection_id" required>
                <option value="">Sélectionnez un article de confection</option>
                <?php foreach ($articlesConfection as $article): ?>
                    <option value="<?= htmlspecialchars($article->getArticleConfectionId()) ?>"
                        <?= (isset($formData['article_confection_id']) && $formData['article_confection_id'] == $article->getArticleConfectionId()) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($article->getNomArticle() . ' (Stock actuel: ' . $article->getQuantiteStock() . ' ' . $article->getUniteMesure() . ')') ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($errors['article_confection_id'])): ?><span class="error-message"><?= htmlspecialchars($errors['article_confection_id']) ?></span><?php endif; ?>
        </div>
        <div>
            <label for="quantite_achetee">Quantité Achetée:</label>
            <input type="number" id="quantite_achetee" name="quantite_achetee" value="<?= htmlspecialchars($formData['quantite_achetee'] ?? '') ?>" required min="1">
            <?php if (!empty($errors['quantite_achetee'])): ?><span class="error-message"><?= htmlspecialchars($errors['quantite_achetee']) ?></span><?php endif; ?>
        </div>
        <div>
            <label for="prix_unitaire_achat">Prix Unitaire d'Achat (F CFA):</label>
            <input type="number" step="0.01" id="prix_unitaire_achat" name="prix_unitaire_achat" value="<?= htmlspecialchars($formData['prix_unitaire_achat'] ?? '') ?>" required min="0.01">
            <?php if (!empty($errors['prix_unitaire_achat'])): ?><span class="error-message"><?= htmlspecialchars($errors['prix_unitaire_achat']) ?></span><?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Mettre à jour' : 'Enregistrer' ?> l'approvisionnement</button>
        <a href="<?= BASE_URL ?>index.php?action=approvisionnements" class="btn btn-secondary">Annuler</a>
    </form>
</main>

<?php require_once ROOT_PATH . '/vues/includes/footer.php'; ?>