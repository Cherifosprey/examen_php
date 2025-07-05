<?php require_once ROOT_PATH . '/vues/includes/header.php'; ?>
<?php // sidebar.php est déjà inclus dans header.php ?>

<main class="content">
    <h2><?= htmlspecialchars($title) ?></h2>

    <?php if (isset($_GET['message'])): ?>
        <p class="success-message"><?= htmlspecialchars($_GET['message']) ?></p>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <p class="error-message"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <a href="<?= BASE_URL ?>index.php?action=ajouterClient" class="btn btn-primary" style="margin-bottom: 20px;">Ajouter un nouveau client</a>

    <?php if (!empty($clients)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?= htmlspecialchars($client->getClientId()) ?></td>
                        <td><?= htmlspecialchars($client->getNom()) ?></td>
                        <td><?= htmlspecialchars($client->getPrenom()) ?></td>
                        <td><?= htmlspecialchars($client->getEmail()) ?></td>
                        <td><?= htmlspecialchars($client->getTelephone()) ?></td>
                        <td><?= htmlspecialchars($client->getStatut()) ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>index.php?action=modifierClient&id=<?= $client->getClientId() ?>" class="btn btn-sm btn-warning">Modifier</a>
                            <a href="<?= BASE_URL ?>index.php?action=archiveClient&id=<?= $client->getClientId() ?>" class="btn btn-sm btn-info" onclick="return confirm('Êtes-vous sûr de vouloir archiver ce client ?');">Archiver</a>
                            <a href="<?= BASE_URL ?>index.php?action=supprimerClient&id=<?= $client->getClientId() ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir SUPPRIMER DÉFINITIVEMENT ce client ? Cette action est irréversible.');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun client trouvé.</p>
    <?php endif; ?>
</main>

<?php require_once ROOT_PATH . '/vues/includes/footer.php'; ?>