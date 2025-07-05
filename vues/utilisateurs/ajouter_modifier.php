<?php require_once ROOT_PATH . '/vues/includes/header.php'; ?>
<?php // La sidebar est déjà incluse ?>

<main class="content">
    <h2><?= htmlspecialchars($title) ?></h2>

    <?php if (!empty($errors['global'])): ?>
        <p class="error-message"><?= htmlspecialchars($errors['global']) ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <div>
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($formData['nom'] ?? '') ?>" required>
            <?php if (!empty($errors['nom'])): ?><span class="error-message"><?= htmlspecialchars($errors['nom']) ?></span><?php endif; ?>
        </div>
        <div>
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($formData['prenom'] ?? '') ?>" required>
            <?php if (!empty($errors['prenom'])): ?><span class="error-message"><?= htmlspecialchars($errors['prenom']) ?></span><?php endif; ?>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($formData['email'] ?? '') ?>" required>
            <?php if (!empty($errors['email'])): ?><span class="error-message"><?= htmlspecialchars($errors['email']) ?></span><?php endif; ?>
        </div>
        <div>
            <label for="mot_de_passe">Mot de passe: <?= $isEdit ? '(Laisser vide pour ne pas changer)' : '' ?></label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" <?= $isEdit ? '' : 'required' ?>>
            <?php if (!empty($errors['mot_de_passe'])): ?><span class="error-message"><?= htmlspecialchars($errors['mot_de_passe']) ?></span><?php endif; ?>
        </div>
        <div>
            <label for="telephone_portable">Téléphone Portable:</label>
            <input type="text" id="telephone_portable" name="telephone_portable" value="<?= htmlspecialchars($formData['telephone_portable'] ?? '') ?>">
        </div>
        <div>
            <label for="adresse">Adresse:</label>
            <textarea id="adresse" name="adresse"><?= htmlspecialchars($formData['adresse'] ?? '') ?></textarea>
        </div>
        <div>
            <label for="salaire">Salaire:</label>
            <input type="number" step="0.01" id="salaire" name="salaire" value="<?= htmlspecialchars($formData['salaire'] ?? '') ?>">
        </div>
        <div>
            <label for="role">Rôle:</label>
            <select id="role" name="role" required>
                <option value="">Sélectionnez un rôle</option>
                <option value="Gestionnaire" <?= ($formData['role'] ?? '') === 'Gestionnaire' ? 'selected' : '' ?>>Gestionnaire</option>
                <option value="Responsable Stock" <?= ($formData['role'] ?? '') === 'Responsable Stock' ? 'selected' : '' ?>>Responsable Stock</option>
                <option value="Responsable Production" <?= ($formData['role'] ?? '') === 'Responsable Production' ? 'selected' : '' ?>>Responsable Production</option>
                <option value="Vendeur" <?= ($formData['role'] ?? '') === 'Vendeur' ? 'selected' : '' ?>>Vendeur</option>
            </select>
            <?php if (!empty($errors['role'])): ?><span class="error-message"><?= htmlspecialchars($errors['role']) ?></span><?php endif; ?>
        </div>
        <div>
            <label for="statut">Statut:</label>
            <select id="statut" name="statut" required>
                <option value="actif" <?= ($formData['statut'] ?? 'actif') === 'actif' ? 'selected' : '' ?>>Actif</option>
                <option value="archivé" <?= ($formData['statut'] ?? '') === 'archivé' ? 'selected' : '' ?>>Archivé</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Mettre à jour' : 'Ajouter' ?> l'utilisateur</button>
        <a href="<?= BASE_URL ?>index.php?action=utilisateurs" class="btn btn-secondary">Annuler</a>
    </form>
</main>

<?php require_once ROOT_PATH . '/vues/includes/footer.php'; ?>