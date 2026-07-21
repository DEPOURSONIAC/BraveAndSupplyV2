<?php
/*
    Point d'entrée principal de l'appli web.
    Crée l'environnement puis laisse le routeur faire le sale boulot.
*/


require_once __DIR__ . "/../config/config.php";
require_once ROOT . "/config/database.php";
require_once ROOT . "/core/router.php";
require_once ROOT . "/core/helpers.php";


// Démarre la session si elle n'est pas déjà active.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Récupère la route/ page demandée.
$route = getRoute();


// Vérifie que l'utilisateur a le droit d'accéder à cette route.
$route = protectRoute($route);


// Récupère les paramètres nécessaires au controllers.
$args = getRouteArguments($route);


// Exécute la fonction associée à la route.
executeRoute($route, $args);