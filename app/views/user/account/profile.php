    <!-- TABLEAU DE BORD -->
                <div class="row gy-4 account-stats">

                    <div class="col-4">
                        <h3 class="account-stat-number"><?= htmlspecialchars($orderCount) ?> </h3>
                        <p class="account-stat-label">Commandes</p>
                    </div>

                    <div class="col-4">
                        <h3 class="account-stat-number"><?= htmlspecialchars($cartCount) ?> </h3>
                        <p class="account-stat-label">Articles au panier</p>
                    </div>

                    <div class="col-4">
                        <h3 class="account-stat-number"><?= htmlspecialchars($reviewCount) ?> </h3>
                        <p class="account-stat-label">Avis publiés</p>
                    </div>

                </div>

                <!-- INFORMATIONS -->
                <div class="account-section">

                    <div class="account-section-header">

                        <h5>Informations personnelles</h5>

                        <a href="<?= BASE_URL ?>?action=accountEdit">
                            Modifier
                        </a>

                    </div>

                    <div class="row gy-4">

                        <div class="col-sm-4">
                            <small>Pseudo</small>
                            <span><?= htmlspecialchars($user['name']) ?></span>
                        </div>

                        <div class="col-sm-4">
                            <small>Adresse e-mail</small>
                            <span> <?= htmlspecialchars($user['email']) ?> </span>
                        </div>

                    </div>

                </div>

                <!-- DERNIÈRE COMMANDE -->
                <div class="account-order">

                    <div class="account-section-header">

                        <h5>Dernière commande</h5>

                        <a href="<?= BASE_URL ?>?action=orders">
                            Toutes les commandes
                        </a>

                    </div>

                    <div class="account-order-box">
                    <?php        foreach ($orders as $order):     ?>
                        <div>
                            <span>N° commande</span>
                            <strong><?= $order['id'] ?></strong>
                        </div>

                        <div>
                            <span>Date</span>
                            <strong><?= $order['created_at'] ?></strong>
                        </div>

                        <div>
                            <span>Total</span>
                            <strong><?= $order['total_price'] ?></strong>
                        </div>

                        <div>
                            <span class="account-status">
                                <?= $order['status'] ?>
                            </span>
                        </div>

                        <a href="<?= BASE_URL ?>?action=order&orderId=<?= (int) $order['id'] ?>">
                            Voir le détail ->
                        </a>
                    <?php      endforeach      ?>
                    </div>

                </div>