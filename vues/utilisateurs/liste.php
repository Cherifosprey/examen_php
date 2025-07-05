<?php require_once ROOT_PATH . '/vues/includes/header.php'; ?>
<?php // La sidebar est déjà incluse dans header.php, pas besoin de la require_once ici. ?>

<main class="content">
    <h2><?= htmlspecialchars($title) ?></h2>

    <?php if (isset($_GET['message'])): ?>
        <p class="success-message"><?= htmlspecialchars($_GET['message']) ?></p>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <p class="error-message"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <a href="<?= BASE_URL ?>index.php?action=ajouterUtilisateur" class="btn btn-primary" style="margin-bottom: 20px;">Ajouter un nouvel utilisateur</a>

    <?php if (!empty($utilisateurs)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateurs as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user->getUtilisateurId()) ?></td>
                        <td><?= htmlspecialchars($user->getNom()) ?></td>
                        <td><?= htmlspecialchars($user->getPrenom()) ?></td>
                        <td><?= htmlspecialchars($user->getEmail()) ?></td>
                        <td><?= htmlspecialchars($user->getRole()) ?></td>
                        <td><?= htmlspecialchars($user->getStatut()) ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>index.php?action=modifierUtilisateur&id=<?= $user->getUtilisateurId() ?>" class="btn btn-sm btn-warning">Modifier</a>
                            <a href="<?= BASE_URL ?>index.php?action=archiveUtilisateur&id=<?= $user->getUtilisateurId() ?>" class="btn btn-sm btn-info" onclick="return confirm('Êtes-vous sûr de vouloir archiver cet utilisateur ?');">Archiver</a>
                            <a href="<?= BASE_URL ?>index.php?action=supprimerUtilisateur&id=<?= $user->getUtilisateurId() ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir SUPPRIMER DÉFINITIVEMENT cet utilisateur ? Cette action est irréversible.');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun utilisateur trouvé.</p>
    <?php endif; ?>
</main>

<?php require_once ROOT_PATH . '/vues/includes/footer.php'; ?>