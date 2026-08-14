<?php

/*
    Point d'entrée principal de l'appli web.
    Crée l'environnement puis laisse le routeur faire le sale boulot.
*/

// ---------------
// AFFICHAGE DES ERREURS( à supp pour la version finale)
// ---------------

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


// ---------------
// CONFIGURATION
// ---------------

require_once __DIR__ . '/../config/config.php';


// ---------------
// SESSION
// ---------------

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// ---------------
// DÉPENDANCES
// ---------------

require_once ROOT . '/config/database.php';
require_once ROOT . '/core/helpers.php';
require_once ROOT . '/core/bootstrap.php';
require_once ROOT . '/core/router.php';


// ---------------
// ROUTING
// ---------------

// Récupère la route demandée
$route = getRoute();

// Vérifie si l'utilisateur peut accéder à cette route
$route = protectRoute($route);

// Récupère les paramètres nécessaires à la fonction
$args = getRouteArguments($route);

// Exécute la fonction associée à la route
executeRoute($route, $args);