            <!-- PANIER -->
            <div class="account-section">

                <div class="account-section-header">

                    <h5>Mon panier</h5>

                    <span class="account-table-count" id="account_table_count">
                        <?= $cart_count ?> article(s)
                    </span>

                </div>


                <?php if (empty($cart['products'])): ?>

                    <!-- PANIER VIDE -->
                    <div class="account-empty">

                        <p>Votre panier est vide.</p>

                        <a href="<?= BASE_URL ?>?action=catalogue"  class="btn-primary" >
                            Continuer mes achats
                        </a>

                    </div>


                <?php else: ?>

                    <!-- TABLEAU DU PANIER -->
                    <div class="table-responsive">

                        <table class="account-table">

                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Prix unitaire</th>
                                    <th>Quantité</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>


                            <tbody>

                                <?php foreach ($cart['products'] as $product): ?>

                                    <tr data-product-id="<?= (int) $product['id'] ?>">

                                        <!-- PRODUIT -->
                                        <td>

                                            <div class="account-table-product">

                                                <img src="<?= BASE_URL ?>assets/images/products/<?= htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>" class="account-table-thumb">

                                                <span>
                                                    <?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>
                                                </span>

                                            </div>

                                        </td>


                                        <!-- PRIX -->
                                        <td style="color: black;">
                                            <?= htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8') ?> €
                                        </td>

                                        <!-- QUANTITÉ -->
                                        <td>
                                            <form method="post" action="<?= BASE_URL ?>?action=updateCart" class="account-qty-form" >
                                                <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">

                                                <div class="quantity-control">

                                                    <button type="button" class="quantity-minus" aria-label="Diminuer la quantité">
                                                        -
                                                    </button>

                                                    <input type="number"  name="quantity" min="1" value="<?= (int) $product['quantity'] ?>" class="quantity-input" aria-label="Quantity">

                                                    <button type="button" class="quantity-plus" aria-label="Augmenter la quantité">
                                                        +
                                                    </button>

                                                </div>
                                            </form>
                                        </td>


                                        <!-- TOTAL PRODUIT -->
                                        <td>
                                            <strong style="color: black;" class="product-total">
                                                <?= htmlspecialchars($product['total_by_product']) ?> €
                                            </strong>
                                        </td>


                                        <!-- SUPPRIMER -->
                                        <td> 


                                            <form action="<?= BASE_URL ?>?action=removeFromCart" method="POST" class="account-remove-form" onsubmit="removeProductFromCart(event)">

                                                <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">

                                                <button type="submit" class="account-table-remove" >
                                                    Retirer
                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            </tbody>

                        </table>

                    </div>


                    <!-- TOTAL DU PANIER -->
                    <div class="account-cart-summary">

                        <div>

                            <span>Total</span>

                            <strong id="cart_total" style="color: black;">
                                <?= htmlspecialchars($cart['total'], ENT_QUOTES, 'UTF-8') ?> €
                            </strong>

                        </div>


                        <a  href="<?= BASE_URL ?>?action=checkout" class="btn-primary" >
                            Passer la commande
                        </a>

                    </div>

                <?php endif; ?>

            </div>
