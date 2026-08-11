            <!-- COMMANDES -->
            <div class="account-section">

                <div class="account-section-header">
                    <h5>Mes commandes</h5>
                    <span class="account-table-count"><?= count($orders) ?> commande(s)</span>
                </div>

                <?php if (empty($orders)): ?>

                    <div class="account-empty">
                        <p>Vous n'avez pas encore passé de commande.</p>
                    </div>

                <?php else: ?>

                    <div class="table-responsive">
                        <table class="account-table">
                            <thead>
                                <tr>
                                    <th>N° commande</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Statut</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <td><strong>#<?= htmlspecialchars($order['id']) ?></strong></td>
                                        <td><?= htmlspecialchars($order['created_at']) ?></td>
                                        <td><?= htmlspecialchars($order['total_price']) ?> €</td>
                                        <td>
                                            <span class="account-status account-status-<?= strtolower(htmlspecialchars($order['status'])) ?>">
                                                <?= htmlspecialchars($order['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?= BASE_URL ?>?action=order&id=<?= (int) $order['id'] ?>"
                                               class="account-table-link">
                                                Voir le détail ->
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                <?php endif; ?>

            </div>