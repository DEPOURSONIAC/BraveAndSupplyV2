<?php

function view(string $page, array $data = []): void
{
    /*
        Affiche une vue.

        Le chemin est construit automatiquement
        à partir du dossier des vues.
    */

    // Transforme les clés du tableau en variables PHP
    extract($data);

    // Charge le fichier de vue
    require VIEW_PATH . "/" . $page . ".php";
}

function redirect(string $route): void
{
    /*
      Redirige l'utilisateur vers une route.
     
      Paramètres :
        - $route : nom de la route cible.
     */
    header("Location: ?action=" . $route);

    exit;
}

function loginUser($user): bool
{
    /*
    Faciliter les sessions

    */
    $result = 0 ;
    
    $_SESSION['id']  = $user['id'];
    $_SESSION['name']  = $user['name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];

    $result = 1;
    return $result ;
}