<?php require_once ROOT_PATH . '/vues/includes/header.php'; ?>

<main class="content">
    <h2><?= htmlspecialchars($title) ?></h2>

    <?php if (!empty($errors['global'])): ?>
        <p class="error-message"><?= htmlspecialchars($errors['global']) ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <div>
            <label for="libelle">Nom de la catégorie:</label> 
            <input type="text" id="libelle" name="libelle" value="<?= htmlspecialchars($formData['libelle'] ?? '') ?>" required> 
            <?php if (!empty($errors['libelle'])): ?><span class="error-message"><?= htmlspecialchars($errors['libelle']) ?></span><?php endif; ?> 
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description"><?= htmlspecialchars($formData['description'] ?? '') ?></textarea>
        </div>
        <div>
            <label for="statut">Statut:</label>
            <select id="statut" name="statut" required>
                <option value="actif" <?= ($formData['statut'] ?? 'actif') === 'actif' ? 'selected' : '' ?>>Actif</option>
                <option value="archivé" <?= ($formData['statut'] ?? '') === 'archivé' ? 'selected' : '' ?>>Archivé</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Mettre à jour' : 'Ajouter' ?> la catégorie</button>
        <a href="<?= BASE_URL ?>index.php?action=categories" class="btn btn-secondary">Annuler</a>
    </form>
</main>

<?php require_once ROOT_PATH . '/vues/includes/footer.php'; ?>