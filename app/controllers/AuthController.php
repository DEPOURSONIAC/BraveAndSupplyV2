<?php

function showLogin(): void
{
    /*
        Affiche la page de connexion.
    */

    view('auth/login');
}

function showRegister(): void
{
    /*
        Affiche la page d'inscription.
    */

    view('auth/register');
}

function login(string $email, string $password): void
{
    /*
        Authentifie un utilisateur.
    */

    if ($email === '' || $password === '') {
        exit('Champs manquants.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit('Adresse email invalide.');
    }

    $user = getUserByEmail($email);

    if (!$user || !password_verify($password, $user['password'])) {
        exit('Identifiants incorrects.');
    }

    loginUser($user);

    redirect('home');
}

function register(string $name, string $email, string $address, string $password, string $password_confirm): void {
    /*
        Inscrit un nouvel utilisateur.

        Vérifie les informations saisies,
        crée le compte puis connecte l'utilisateur.
    */

    if ($name === '' || $email === '' || $address === '' || $password === '' || $password_confirm === '') {
        exit('Champs manquants.');
    }

    if ($password !== $password_confirm) {
        exit('Les mots de passe ne correspondent pas.');
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    createUser($name, $email, $address, $hashed_password);

    $user = getUserByEmail($email);

    if (!$user) {
        exit('Impossible de récupérer le compte créé.');
    }

    loginUser($user);

    redirect('home');
}

function logout(): void
{
    /*
        Déconnecte l'utilisateur.
    */

    // Vide les données de session.
    $_SESSION = [];

    // Supprime le cookie de session.
    if (ini_get('session.use_cookies')) {

        $params = session_get_cookie_params();

        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    // Détruit la session.
    session_destroy();

    redirect('login');
}