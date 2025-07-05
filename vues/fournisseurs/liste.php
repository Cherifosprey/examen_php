<?php require_once ROOT_PATH . '/vues/includes/header.php'; ?>

<main class="content">
    <h2><?= htmlspecialchars($title) ?></h2>

    <?php if (isset($_GET['message'])): ?>
        <p class="success-message"><?= htmlspecialchars($_GET['message']) ?></p>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <p class="error-message"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <a href="<?= BASE_URL ?>index.php?action=ajouterFournisseur" class="btn btn-primary" style="margin-bottom: 20px;">Ajouter un nouveau fournisseur</a>

    <?php if (!empty($fournisseurs)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom Entreprise</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                
                <?php foreach ($fournisseurs as $fournisseur): ?>
                    <tr>
                        <td><?= htmlspecialchars($fournisseur->getFournisseurId()) ?></td>
                        <td><?= htmlspecialchars($fournisseur->getNomEntreprise()) ?></td>
                        <td><?= htmlspecialchars($fournisseur->getContactPersonne()) ?></td>
                        <td><?= htmlspecialchars($fournisseur->getEmail()) ?></td>
                        <td><?= htmlspecialchars($fournisseur->getTelephone()) ?></td>
                        <td><?= htmlspecialchars($fournisseur->getStatut()) ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>index.php?action=modifierFournisseur&id=<?= $fournisseur->getFournisseurId() ?>" class="btn btn-sm btn-warning">Modifier</a>
                            <a href="<?= BASE_URL ?>index.php?action=archiveFournisseur&id=<?= $fournisseur->getFournisseurId() ?>" class="btn btn-sm btn-info" onclick="return confirm('Êtes-vous sûr de vouloir archiver ce fournisseur ?');">Archiver</a>
                            <a href="<?= BASE_URL ?>index.php?action=supprimerFournisseur&id=<?= $fournisseur->getFournisseurId() ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir SUPPRIMER DÉFINITIVEMENT ce fournisseur ? Cette action est irréversible.');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun fournisseur trouvé.</p>
    <?php endif; ?>
</main>

<?php require_once ROOT_PATH . '/vues/includes/footer.php'; ?>