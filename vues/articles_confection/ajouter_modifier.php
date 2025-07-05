<?php require_once ROOT_PATH . '/vues/includes/header.php'; ?>

<main class="content">
    <h2><?= htmlspecialchars($title) ?></h2>

    <?php if (!empty($errors['global'])): ?>
        <p class="error-message"><?= htmlspecialchars($errors['global']) ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <div>
            <label for="nom_article">Nom de l'article:</label>
            <input type="text" id="nom_article" name="nom_article" value="<?= htmlspecialchars($formData['nom_article'] ?? '') ?>" required>
            <?php if (!empty($errors['nom_article'])): ?><span class="error-message"><?= htmlspecialchars($errors['nom_article']) ?></span><?php endif; ?>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description"><?= htmlspecialchars($formData['description'] ?? '') ?></textarea>
        </div>
        <div>
            <label for="prix_unitaire_achat">Prix unitaire d'achat:</label>
            <input type="number" step="0.01" id="prix_unitaire_achat" name="prix_unitaire_achat" value="<?= htmlspecialchars($formData['prix_unitaire_achat'] ?? '') ?>" required>
            <?php if (!empty($errors['prix_unitaire_achat'])): ?><span class="error-message"><?= htmlspecialchars($errors['prix_unitaire_achat']) ?></span><?php endif; ?>
        </div>
        <div>
            <label for="unite_mesure">Unité de mesure:</label>
            <input type="text" id="unite_mesure" name="unite_mesure" value="<?= htmlspecialchars($formData['unite_mesure'] ?? '') ?>" required>
            <?php if (!empty($errors['unite_mesure'])): ?><span class="error-message"><?= htmlspecialchars($errors['unite_mesure']) ?></span><?php endif; ?>
        </div>
        <div>
            <label for="quantite_stock">Quantité en stock:</label>
            <input type="number" id="quantite_stock" name="quantite_stock" value="<?= htmlspecialchars($formData['quantite_stock'] ?? '') ?>" required>
            <?php if (!empty($errors['quantite_stock'])): ?><span class="error-message"><?= htmlspecialchars($errors['quantite_stock']) ?></span><?php endif; ?>
        </div>
        <div>
            <label for="fournisseur_id">Fournisseur:</label>
            <select id="fournisseur_id" name="fournisseur_id" required>
                <option value="">Sélectionnez un fournisseur</option>
                <?php foreach ($fournisseurs as $fournisseur): ?>
                    <option value="<?= htmlspecialchars($fournisseur->getFournisseurId()) ?>"
                        <?= (isset($formData['fournisseur_id']) && $formData['fournisseur_id'] == $fournisseur->getFournisseurId()) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($fournisseur->getNomEntreprise() ?? 'Fournisseur Inconnu') ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($errors['fournisseur_id'])): ?><span class="error-message"><?= htmlspecialchars($errors['fournisseur_id']) ?></span><?php endif; ?>
        </div>
        <div>
            <label for="categorie_id">Catégorie:</label>
            <select id="categorie_id" name="categorie_id" required>
                <option value="">Sélectionnez une catégorie</option>
                <?php foreach ($categories as $categorie): ?>
                    <option value="<?= htmlspecialchars($categorie->getCategorieId()) ?>"
                        <?= (isset($formData['categorie_id']) && $formData['categorie_id'] == $categorie->getCategorieId()) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($categorie->getLibelle() ?? 'Catégorie Inconnue') ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($errors['categorie_id'])): ?><span class="error-message"><?= htmlspecialchars($errors['categorie_id']) ?></span><?php endif; ?>
        </div>
        <div>
            <label for="statut">Statut:</label>
            <select id="statut" name="statut" required>
                <option value="actif" <?= ($formData['statut'] ?? 'actif') === 'actif' ? 'selected' : '' ?>>Actif</option>
                <option value="inactif" <?= ($formData['statut'] ?? '') === 'inactif' ? 'selected' : '' ?>>Inactif</option>
                <option value="rupture" <?= ($formData['statut'] ?? '') === 'rupture' ? 'selected' : '' ?>>Rupture de stock</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Mettre à jour' : 'Ajouter' ?> l'article</button>
        <a href="<?= BASE_URL ?>index.php?action=articlesConfection" class="btn btn-secondary">Annuler</a>
    </form>
</main>

<?php require_once ROOT_PATH . '/vues/includes/footer.php'; ?>