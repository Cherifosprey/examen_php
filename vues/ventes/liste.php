<?php require_once ROOT_PATH . '/vues/includes/header.php'; ?>

<main class="content">
    <h2><?= htmlspecialchars($title) ?></h2>

    <?php if (isset($_GET['message'])): ?>
        <p class="success-message"><?= htmlspecialchars($_GET['message']) ?></p>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <p class="error-message"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <a href="<?= BASE_URL ?>index.php?action=ajouterVente" class="btn btn-primary" style="margin-bottom: 20px;">Enregistrer une nouvelle vente</a>

    <?php if (!empty($ventes)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID Vente</th>
                    <th>Client</th>
                    <th>Date Vente</th>
                    <th>Total</th>
                    <th>Vendeur</th>
                    <th>Statut Paiement</th>
                    <th>Mode Paiement</th>
                    <th>Articles Vendus</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventes as $vente): ?>
                    <tr>
                        <td><?= htmlspecialchars($vente->getVenteId() ?? '') ?></td>
                        <td><?= htmlspecialchars($vente->client_nom ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($vente->getDateVente() ?? '') ?></td>
                        <td><?= htmlspecialchars(number_format($vente->getTotalVente() ?? 0, 2) . ' F') ?></td>
                        <td><?= htmlspecialchars($vente->utilisateur_nom ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($vente->getStatutPaiement() ?? '') ?></td>
                        <td><?= htmlspecialchars($vente->getModePaiement() ?? '') ?></td>
                        <td>
                            <?php
                            $details = $vente->getDetailsProduitsVendus();
                            if (!empty($details)):
                                echo '<ul>';
                                foreach ($details as $item):
                                    echo '<li>' . htmlspecialchars($item['quantite_vendue'] . ' x ' . $item['nom_produit'] . ' (' . number_format($item['prix_unitaire_vente'], 2) . ' F/unité)') . '</li>';
                                endforeach;
                                echo '</ul>';
                            else:
                                echo 'Aucun article';
                            endif;
                            ?>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>index.php?action=modifierVente&id=<?= $vente->getVenteId() ?>" class="btn btn-sm btn-warning">Modifier</a>
                            <a href="<?= BASE_URL ?>index.php?action=supprimerVente&id=<?= $vente->getVenteId() ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir SUPPRIMER DÉFINITIVEMENT cette vente ? Cela n\'annulera PAS le stock des articles vendus.');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucune vente trouvée.</p>
    <?php endif; ?>
</main>

<?php require_once ROOT_PATH . '/vues/includes/footer.php'; ?>