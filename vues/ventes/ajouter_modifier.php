<?php require_once ROOT_PATH . '/vues/includes/header.php'; ?>

<main class="content">
    <h2><?= htmlspecialchars($title) ?></h2>

    <?php if (!empty($errors['global'])): ?>
        <p class="error-message"><?= htmlspecialchars($errors['global']) ?></p>
    <?php endif; ?>
    <?php if (!empty($errors['articles'])): ?>
        <p class="error-message"><?= htmlspecialchars($errors['articles']) ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <div>
            <label for="client_id">Client:</label>
            <select id="client_id" name="client_id" required>
                <option value="">Sélectionnez un client</option>
                <?php foreach ($clients as $client): ?>
                    <option value="<?= htmlspecialchars($client->getClientId()) ?>"
                        <?= (isset($formData['client_id']) && $formData['client_id'] == $client->getClientId()) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($client->getNom() . ' ' . $client->getPrenom()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($errors['client_id'])): ?><span class="error-message"><?= htmlspecialchars($errors['client_id']) ?></span><?php endif; ?>
        </div>

        <fieldset>
            <legend>Articles Vendus</legend>
            <div id="articles-container">
                <?php
                // Si c'est une édition, ou si le formulaire a été soumis avec des erreurs,
                // pré-remplir les articles.
                if (isset($formData['details_produits_vendus']) && is_array($formData['details_produits_vendus'])):
                    foreach ($formData['details_produits_vendus'] as $index => $item):
                ?>
                    <div class="article-item" data-index="<?= $index ?>">
                        <label for="article_id_<?= $index ?>">Article:</label>
                        <select name="articles[<?= $index ?>][article_id]" id="article_id_<?= $index ?>" required>
                            <option value="">Sélectionnez un article</option>
                            <?php foreach ($articlesVente as $article): ?>
                                <option value="<?= htmlspecialchars($article->getArticleVenteId()) ?>"
                                    <?= (isset($item['article_vente_id']) && $item['article_vente_id'] == $article->getArticleVenteId()) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($article->getNomProduit() . ' (Stock: ' . $article->getQuantiteStock() . ')') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <label for="quantite_<?= $index ?>">Quantité:</label>
                        <input type="number" name="articles[<?= $index ?>][quantite]" id="quantite_<?= $index ?>" value="<?= htmlspecialchars($item['quantite_vendue'] ?? '') ?>" required min="1">

                        <button type="button" class="btn btn-sm btn-danger remove-article-btn">Supprimer</button>
                    </div>
                <?php
                    endforeach;
                else: // Pour un nouvel ajout, ou si aucun article n'est encore ajouté
                ?>
                    <div class="article-item" data-index="0">
                        <label for="article_id_0">Article:</label>
                        <select name="articles[0][article_id]" id="article_id_0" required>
                            <option value="">Sélectionnez un article</option>
                            <?php foreach ($articlesVente as $article): ?>
                                <option value="<?= htmlspecialchars($article->getArticleVenteId()) ?>">
                                    <?= htmlspecialchars($article->getNomProduit() . ' (Stock: ' . $article->getQuantiteStock() . ')') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <label for="quantite_0">Quantité:</label>
                        <input type="number" name="articles[0][quantite]" id="quantite_0" value="1" required min="1">

                        <button type="button" class="btn btn-sm btn-danger remove-article-btn">Supprimer</button>
                    </div>
                <?php endif; ?>
            </div>
            <button type="button" id="add-article-btn" class="btn btn-secondary" style="margin-top: 10px;">Ajouter un autre article</button>
        </fieldset>

        <div>
            <label for="statut_paiement">Statut Paiement:</label>
            <select id="statut_paiement" name="statut_paiement" required>
                <option value="en_attente" <?= ($formData['statut_paiement'] ?? 'en_attente') === 'en_attente' ? 'selected' : '' ?>>En Attente</option>
                <option value="paye" <?= ($formData['statut_paiement'] ?? '') === 'paye' ? 'selected' : '' ?>>Payé</option>
                <option value="annule" <?= ($formData['statut_paiement'] ?? '') === 'annule' ? 'selected' : '' ?>>Annulé</option>
            </select>
        </div>
        <div>
            <label for="mode_paiement">Mode de Paiement:</label>
            <select id="mode_paiement" name="mode_paiement">
                <option value="">Sélectionnez un mode</option>
                <option value="especes" <?= ($formData['mode_paiement'] ?? '') === 'especes' ? 'selected' : '' ?>>Espèces</option>
                <option value="carte" <?= ($formData['mode_paiement'] ?? '') === 'carte' ? 'selected' : '' ?>>Carte Bancaire</option>
                <option value="virement" <?= ($formData['mode_paiement'] ?? '') === 'virement' ? 'selected' : '' ?>>Virement Bancaire</option>
                <option value="mobile_money" <?= ($formData['mode_paiement'] ?? '') === 'mobile_money' ? 'selected' : '' ?>>Mobile Money</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Mettre à jour' : 'Enregistrer' ?> la vente</button>
        <a href="<?= BASE_URL ?>index.php?action=ventes" class="btn btn-secondary">Annuler</a>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const articlesContainer = document.getElementById('articles-container');
            const addArticleBtn = document.getElementById('add-article-btn');
            let articleIndex = articlesContainer.children.length > 0 ? parseInt(articlesContainer.lastElementChild.dataset.index) + 1 : 0;

            function addArticleItem(articleId = '', quantite = 1) {
                const newArticleItem = document.createElement('div');
                newArticleItem.classList.add('article-item');
                newArticleItem.dataset.index = articleIndex;
                newArticleItem.innerHTML = `
                    <label for="article_id_${articleIndex}">Article:</label>
                    <select name="articles[${articleIndex}][article_id]" id="article_id_${articleIndex}" required>
                        <option value="">Sélectionnez un article</option>
                        <?php foreach ($articlesVente as $article): ?>
                            <option value="<?= htmlspecialchars($article->getArticleVenteId()) ?>"
                                <?= (isset($item['article_vente_id']) && $item['article_vente_id'] == $article->getArticleVenteId()) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($article->getNomProduit() . ' (Stock: ' . $article->getQuantiteStock() . ')') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="quantite_${articleIndex}">Quantité:</label>
                    <input type="number" name="articles[${articleIndex}][quantite]" id="quantite_${articleIndex}" value="${quantite}" required min="1">

                    <button type="button" class="btn btn-sm btn-danger remove-article-btn">Supprimer</button>
                `;
                articlesContainer.appendChild(newArticleItem);
                articleIndex++;
                attachRemoveListeners();
            }

            function attachRemoveListeners() {
                document.querySelectorAll('.remove-article-btn').forEach(button => {
                    button.onclick = function() {
                        if (articlesContainer.children.length > 1) { // Toujours laisser au moins un article
                            button.closest('.article-item').remove();
                            // Optionnel: Réorganiser les index après suppression, mais pas strictement nécessaire pour PHP
                            // car PHP accepte des clés non séquentielles dans un tableau POST.
                        } else {
                            alert("Une vente doit contenir au moins un article.");
                        }
                    };
                });
            }

            addArticleBtn.addEventListener('click', () => addArticleItem());
            attachRemoveListeners(); // Attacher les listeners aux éléments existants au chargement de la page

            // Si c'est une édition, et qu'il n'y a pas d'articles pré-remplis (ou si seulement le premier a été généré),
            // s'assurer que `articleIndex` est correct pour les futurs ajouts.
            if (articlesContainer.children.length === 1 && articlesContainer.firstElementChild.dataset.index === "0" && !<?= json_encode($isEdit) ?>) {
                articleIndex = 1;
            }
        });
    </script>
</main>

<?php require_once ROOT_PATH . '/vues/includes/footer.php'; ?>