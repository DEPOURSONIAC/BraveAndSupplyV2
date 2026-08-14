<?php

function view(string $page, array $data = []): void
{
    /*
        Affiche une vue.

        Le chemin est construit automatiquement
        à partir du dossier des vues.
    */

    extract($data);

    require VIEW_PATH . '/' . $page . '.php';
}


function redirect(string $route): void
{
    /*
        Redirige l'utilisateur vers une route.

        Exemple :
            redirect('home');

        Produit :
            ?action=home
    */

    header('Location: ?action=' . $route);

    exit;
}


function loginUser(array $user): bool
{
    /*
        Initialise la session de l'utilisateur connecté.
    */

    session_regenerate_id(true);

    $_SESSION['id'] = $user['id'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];

    return true;
}