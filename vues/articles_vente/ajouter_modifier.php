<?php require_once ROOT_PATH . '/vues/includes/header.php'; ?>

<main class="content">
    <h2><?= htmlspecialchars($title) ?></h2>

    <?php if (!empty($errors['global'])): ?>
        <p class="error-message"><?= htmlspecialchars($errors['global']) ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <div>
            <label for="nom_produit">Nom du produit:</label>
            <input type="text" id="nom_produit" name="nom_produit" value="<?= htmlspecialchars($formData['nom_produit'] ?? '') ?>" required>
            <?php if (!empty($errors['nom_produit'])): ?><span class="error-message"><?= htmlspecialchars($errors['nom_produit']) ?></span><?php endif; ?>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description"><?= htmlspecialchars($formData['description'] ?? '') ?></textarea>
        </div>
        <div>
            <label for="prix_vente">Prix de vente:</label>
            <input type="number" step="0.01" id="prix_vente" name="prix_vente" value="<?= htmlspecialchars($formData['prix_vente'] ?? '') ?>" required>
            <?php if (!empty($errors['prix_vente'])): ?><span class="error-message"><?= htmlspecialchars($errors['prix_vente']) ?></span><?php endif; ?>
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
            <label for="quantite_stock">Quantité en stock:</label>
            <input type="number" id="quantite_stock" name="quantite_stock" value="<?= htmlspecialchars($formData['quantite_stock'] ?? '') ?>" required>
            <?php if (!empty($errors['quantite_stock'])): ?><span class="error-message"><?= htmlspecialchars($errors['quantite_stock']) ?></span><?php endif; ?>
        </div>
        <div>
            <label for="statut">Statut:</label>
            <select id="statut" name="statut" required>
                <option value="disponible" <?= ($formData['statut'] ?? 'disponible') === 'disponible' ? 'selected' : '' ?>>Disponible</option>
                <option value="indisponible" <?= ($formData['statut'] ?? '') === 'indisponible' ? 'selected' : '' ?>>Indisponible</option>
                <option value="en_rupture" <?= ($formData['statut'] ?? '') === 'en_rupture' ? 'selected' : '' ?>>En Rupture</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Mettre à jour' : 'Ajouter' ?> le produit</button>
        <a href="<?= BASE_URL ?>index.php?action=articlesVente" class="btn btn-secondary">Annuler</a>
    </form>
</main>

<?php require_once ROOT_PATH . '/vues/includes/footer.php'; ?>