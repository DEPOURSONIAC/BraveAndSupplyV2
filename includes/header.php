<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Brave & Supply</title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/templatemo-hexashop.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/owl-carousel.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/lightbox.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
    
</head>

<body>

<header class="header-area header-sticky">

    <div class="container">

        <div class="row">

            <div class="col-12">

                <nav class="main-nav">

                    <!-- Logo -->
                    <a href="<?= BASE_URL ?>" class="logo">

                        <img src="<?= BASE_URL ?>assets/images/logo_site.png" alt="Logo Brave & Supply" width="100">

                    </a>

                    <!-- Menu -->
                    <ul class="nav">

                        <li>
                            <a href="<?= BASE_URL ?>">
                                Accueil
                            </a>
                        </li>

                        <li>
                            <a href="<?= BASE_URL ?>?action=category&id=1">
                                Hommes
                            </a>
                        </li>

                        <li>
                            <a href="<?= BASE_URL ?>?action=category&id=2">
                                Femmes
                            </a>
                        </li>

                        <li>
                            <a href="<?= BASE_URL ?>?action=category&id=3">
                                Enfants
                            </a>
                        </li>

                        <!-- Menu utilisateur -->
                        <li class="submenu" id="menuUtilisateur"">

                            <a href="javascript:;" id="userDropdown">

                                <?= isset($_SESSION['id']) ? htmlspecialchars($_SESSION['name']) : 'Invité'; ?>

                            </a>

                            <ul id="userMenu">

                                <?php if (!isset($_SESSION['id'])): ?>

                                    <li>
                                        <a href="<?= BASE_URL ?>?action=login">
                                            Connexion
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?= BASE_URL ?>?action=register">
                                            Inscription
                                        </a>
                                    </li>

                                <?php else: ?>

                                    <li>
                                        <a href="<?= BASE_URL ?>?action=account">
                                            Mon compte
                                        </a>
                                    </li>

                                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>

                                        <li>
                                            <a href="<?= BASE_URL ?>?action=admin">
                                                Administration
                                            </a>
                                        </li>

                                    <?php endif; ?>

                                    <li>
                                        <a href="<?= BASE_URL ?>?action=logout">
                                            Déconnexion
                                        </a>
                                    </li>

                                <?php endif; ?>

                            </ul>

                        </li>

                        <li class="submenu">

                            <a href="javascript:;">
                                Pages
                            </a>

                            <ul>

                                <li>
                                    <a href="<?= BASE_URL ?>?action=catalogue">
                                        Catalogue
                                    </a>
                                </li>

                                <li>
                                    <a href="<?= BASE_URL ?>?action=about">
                                        À propos
                                    </a>
                                </li>

                                <li>
                                    <a href="<?= BASE_URL ?>?action=contact">
                                        Contact
                                    </a>
                                </li>

                            </ul>

                        </li>

                    </ul>

                </nav>

            </div>

        </div>

    </div>

</header>

