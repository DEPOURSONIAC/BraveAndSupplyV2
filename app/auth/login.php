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
</main>