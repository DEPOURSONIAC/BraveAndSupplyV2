<?php require_once INCLUDE_PATH . '/header.php'; ?>

<main id="account-main">

    <section class="section">

        <div class="container account-container">

            <!-- PROFIL -->
            <div class="account-profile">

                <div class="account-avatar">
                    <?= substr($user['name'], 0,1)?>
                </div>

                <div>
                    <h4 class="mb-1">
                        <?= htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?></h4>
                    <p class="account-email mb-0">
                        <?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?>
                    </p>
                </div>

            </div>

            <!-- MENU -->
            <ul class="account-menu" onclick="readAccount(event)">

                <li>
                    <a class="active" href="<?= BASE_URL ?>?action=profile">
                        Profil
                    </a>
                </li>

                <li>
                    <a href="<?= BASE_URL ?>?action=orders">
                        Commandes
                    </a>
                </li>

                <li>
                    <a href="<?= BASE_URL ?>?action=cart">
                        Panier
                    </a>
                </li>

                <li>
                    <a href="<?= BASE_URL ?>?action=reviews">
                        Avis
                    </a>
                </li>

            </ul>

            <section id="account-content">
                <?php require VIEW_PATH . '/user/account/profile.php'; ?>
            </section>
        </div>

    </section>

</main>

<?php require_once INCLUDE_PATH . '/footer.php'; ?>