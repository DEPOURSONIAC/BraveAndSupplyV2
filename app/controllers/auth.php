<?php

require_once MODEL_PATH . '/AuthModel.php';

function loginPage(): void
{
    /*
        Affiche la page de connexion.
    */

    view('auth/login');
}

function registerPage(): void
{
    /*
        Affiche la page d'inscription.
    */

    view('auth/register');
}

function login(): void
{
    /*
        Authentifie un utilisateur.
    */

    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    if (!$email || !$password) {
        exit('Champs manquants.');
    }

    $user = getUserByEmail($email);

    if (!$user || !password_verify($password, $user['password'])) {
        exit('Identifiants incorrects.');
    }

    loginUser($user);

    redirect('home');
}

function register(): void
{
    /*
        Inscrit un nouvel utilisateur.

        Vérifie les informations saisies,
        crée le compte puis redirige vers
        la page de connexion.
    */

    $name = $_POST['name'] ?? null;
    $email = $_POST['email'] ?? null;
    $address = $_POST['address'] ?? null;
    $password = $_POST['password'] ?? null;
    $passwordConfirm = $_POST['password_confirm'] ?? null;

    if ( !$name || !$email || !$address|| !$password || !$passwordConfirm ) {
        exit('Champs manquants.');
    }

    if ($password !== $passwordConfirm) {
        exit('Les mots de passe ne correspondent pas.');
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    createUser($name, $email, $address,$hashedPassword);

    $user = getUserByEmail($email);

    loginUser($user);

    redirect('home');
}

function logout(): void
{
    /*
        Déconnecte l'utilisateur.
    */

    // On vide les données
    $_SESSION = [];
    
    // On supprime le cookie de session (IMPORTANT)
    if (ini_get('session.use_cookies')) {

        $params = session_get_cookie_params();

        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly'] );
    }

    // On détruit la session serveur
    session_destroy();

    // Redirection
    redirect('login');
}
