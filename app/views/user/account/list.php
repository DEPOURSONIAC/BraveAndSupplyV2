<div class="list-content" data-list-id="<?= (int) $list_id ?>">

    <div class="account-section-header">
        <h5>Contenu de la liste</h5>

        <a href="<?= BASE_URL ?>?action=account">
            <- Retour au compte
        </a>
    </div>

    <?php if (!empty($products)): ?>

        <div class="table-responsive">

            <table class="account-table">

                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($products as $product): ?>

                        <tr>

                            <td>
                                <div class="account-table-product">

                                    <img src="<?= !empty($product['image']) ? htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8') : BASE_URL . 'assets/images/no-image.jpg' ?>"
                                         alt="<?= htmlspecialchars($product['name'] ?? 'Produit', ENT_QUOTES, 'UTF-8') ?>"
                                         class="account-table-thumb">

                                    <span>
                                        <?= htmlspecialchars($product['name'] ?? 'Produit', ENT_QUOTES, 'UTF-8') ?>
                                    </span>

                                </div>
                            </td>

                            <td>
                                <?= isset($product['price']) ? number_format((float) $product['price'], 2, ',', ' ') . ' €' : '—' ?>
                            </td>

                            <td>
                                <!-- Statique pour l'instant -->
                                <button type="button" class="account-table-remove list-item-remove-btn" title="Retirer de la liste" data-product-id="<?= (int) $product['id'] ?>">
                                    <i class="fa fa-times"></i>
                                    Retirer
                                </button>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php else: ?>

        <div class="account-empty">
            <p>Cette liste ne contient aucun produit pour le moment.</p>
        </div>

    <?php endif; ?>

</div>