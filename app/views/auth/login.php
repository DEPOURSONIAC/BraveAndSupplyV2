<?php require_once INCLUDE_PATH . '/header.php'; ?>

<main class="pt-5">
<div class="page">

    <div class="card">

        <h1>Connexion</h1>

        <p>Accédez à votre espace</p>

        <form action="<?= BASE_URL ?>?action=login" method="POST">

            <input type="email" name="email" placeholder="Email" autocomplete="email" required >

            <input type="password" name="password" placeholder="Mot de passe"autocomplete="current-password"  required>

            <div class="options">

                <label>
                    <input type="checkbox" name="remember" value="1">
                    Se souvenir
                </label>

               <a href="<?= BASE_URL ?>?action=forgotPassword">
                    Mot de passe oublié ?
                </a>

            </div>

            <button type="submit">
                Se connecter
            </button>

        </form>

        <div class="bottom">

            Pas de compte ?

            <a href="<?= BASE_URL ?>?action=register">
                Créer un compte
            </a>

        </div>

    </div>

</div>

<?php /* if (!empty($error)): ?>

    <div class="alert alert-danger" role="alert">
        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
    </div>

<?php endif; */?>
</main>

<?php require_once INCLUDE_PATH . '/footer.php'; ?>