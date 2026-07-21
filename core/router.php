<?php
require_once CONTROLLER_PATH . "/home.php";
require_once CONTROLLER_PATH . "/auth.php";
require_once CONTROLLER_PATH . "/product.php";

function allRoutes(): array
{
    /*
        Retourne toutes les routes disponibles.

        Chaque route définit :
        - les fonctions à exécuter selon la méthode HTTP ;
        - les paramètres attendus.
    */

    return [

        // Pages générales
        'home' => [
            'GET' => 'home',
            'params' => []
        ],

        'contact' => [
            'GET' => 'contact',
            'params' => []
        ],

        'about' => [
            'GET' => 'about',
            'params' => []
        ],

        // Authentification
        'login' => [
            'GET'  => 'loginPage',
            'POST' => 'login',
            'params' => []
        ],

        'register' => [
            'GET'  => 'registerPage',
            'POST' => 'register',
            'params' => []
        ],

        'logout' => [
            'GET' => 'logout',
            'params' => []
        ],

        // Produits
        'product' => [
            'GET' => 'showProduct',
            'params' => ['id']
        ],

    ];
}

function getRoute(): array
{
    /*
        Retourne la route demandée par l'utilisateur.

        Si aucune action n'est présente dans l'URL,
        la page d'accueil est utilisée par défaut.
    */

    $routes = allRoutes();

    $action = $_GET['action'] ?? 'home';

    if (!isset($routes[$action])) {
        http_response_code(404);
        exit('Page introuvable');
    }

    $route = $routes[$action];

    $route['name'] = $action;

    return $route;
}

function protectRoute(array $route): array
{
    /*
        Vérifie que l'utilisateur peut accéder
        à la route demandée.

        Si l'accès est refusé, une route autorisée
        est retournée.
    */

    $isLogged = isset($_SESSION['id']);

    $routes = allRoutes();

    if (!$isLogged && !in_array($route['name'], ['login', 'register'], true)) {

        $route = $routes['login'];
        $route['name'] = 'login';
    }

    elseif ($isLogged && $route['name'] === 'login') {

        $route = $routes['home'];
        $route['name'] = 'home';
    }

    return $route;
}

function getRouteArguments(array $route): array
{
    /*
        Retourne les paramètres attendus
        par la route.
    */

    $args = [];

    foreach ($route['params'] as $param) {

        $value = $_GET[$param] ?? null;

        if ($value === null) {
            exit("Le paramètre " . $param . " est manquant.");
        }

        $args[] = $value;
    }

    return $args;
}

function executeRoute(array $route, array $args): void
{
    /*
        Exécute la fonction associée
        à la route et à la méthode HTTP.
    */

    $method = $_SERVER['REQUEST_METHOD'];

    if (!isset($route[$method])) {
        http_response_code(405);
        exit('Méthode non autorisée');
    }

    $route[$method](...$args);
}