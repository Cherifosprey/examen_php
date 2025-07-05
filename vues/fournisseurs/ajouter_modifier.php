<?php require_once ROOT_PATH . '/vues/includes/header.php'; ?>

<main class="content">
    <h2><?= htmlspecialchars($title) ?></h2>

    <?php if (!empty($errors['global'])): ?>
        <p class="error-message"><?= htmlspecialchars($errors['global']) ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <div>
            <label for="nom_entreprise">Nom de l'entreprise:</label>
            <input type="text" id="nom_entreprise" name="nom_entreprise" value="<?= htmlspecialchars($formData['nom_entreprise'] ?? '') ?>" required>
            <?php if (!empty($errors['nom_entreprise'])): ?><span class="error-message"><?= htmlspecialchars($errors['nom_entreprise']) ?></span><?php endif; ?>
        </div>
        <div>
            <label for="contact_personne">Personne Contact:</label>
            <input type="text" id="contact_personne" name="contact_personne" value="<?= htmlspecialchars($formData['contact_personne'] ?? '') ?>">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($formData['email'] ?? '') ?>" required>
            <?php if (!empty($errors['email'])): ?><span class="error-message"><?= htmlspecialchars($errors['email']) ?></span><?php endif; ?>
        </div>
        <div>
            <label for="telephone">Téléphone:</label>
            <input type="text" id="telephone" name="telephone" value="<?= htmlspecialchars($formData['telephone'] ?? '') ?>">
        </div>
        <div>
            <label for="adresse">Adresse:</label>
            <textarea id="adresse" name="adresse"><?= htmlspecialchars($formData['adresse'] ?? '') ?></textarea>
        </div>
        <div>
            <label for="statut">Statut:</label>
            <select id="statut" name="statut" required>
                <option value="actif" <?= ($formData['statut'] ?? 'actif') === 'actif' ? 'selected' : '' ?>>Actif</option>
                <option value="archivé" <?= ($formData['statut'] ?? '') === 'archivé' ? 'selected' : '' ?>>Archivé</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Mettre à jour' : 'Ajouter' ?> le fournisseur</button>
        <a href="<?= BASE_URL ?>index.php?action=fournisseurs" class="btn btn-secondary">Annuler</a>
    </form>
</main>

<?php require_once ROOT_PATH . '/vues/includes/footer.php'; ?>