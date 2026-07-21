<?php require_once INCLUDE_PATH . '/header.php'; ?>

<div class="page">

    <div class="card">

        <h1>Connexion</h1>

        <p>Accède à ton espace</p>

        <form action="<?= BASE_URL ?>?action=login" method="POST">

            <input
                type="email"
                name="email"
                placeholder="Email"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Mot de passe"
                required
            >

            <div class="options">

                <label>
                    <input type="checkbox" name="remember">
                    Se souvenir
                </label>

                <a href="#">Mot de passe oublié</a>

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

<?php require_once INCLUDE_PATH . '/footer.php'; ?>