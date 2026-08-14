<?php

function allRoutes(): array
{
    /*
        Déclare toutes les routes/ action de l'application.

        Chaque méthode HTTP définit :
        - la fonction du 'controllers' à exécuter ;
        - les paramètres nécessaires pour la page.

        Les paramètres sont récupérés par le Router
        depuis $_GET ou $_POST selon la méthode HTTP à travers le CRUD.
    */

    return [

        // Pages générales


        'home' => [
            'GET' => [
                'function' => 'showHome',
                'params' => []
            ]
        ],

        'contact' => [
            'GET' => [
                'function' => 'showContact',
                'params' => []
            ]
        ],

        'about' => [
            'GET' => [
                'function' => 'showAbout',
                'params' => []
            ]
        ],

        // Pages légales

        'infos' => [
            'GET' => [
                'function' => 'showInfos',
                'params' => []
            ]
        ],

        'cgv' => [
            'GET' => [
                'function' => 'showCgv',
                'params' => []
            ]
        ],

        'reglement' => [
            'GET' => [
                'function' => 'showReglement',
                'params' => []
            ]
        ],

        'mentions' => [
            'GET' => [
                'function' => 'showMentions',
                'params' => []
            ]
        ],

        // Compte utilisateur

        'account' => [
            'GET' => [
                'function' => 'showAccount',
                'params' => []
            ]
        ],

        'profile' => [
            'GET' => [
                'function' => 'showProfile',
                'params' => []
            ]
        ],

        'orders' => [
            'GET' => [
                'function' => 'showOrders',
                'params' => []
            ]
        ],

        'reviews' => [
            'GET' => [
                'function' => 'showReviews',
                'params' => []
            ]
        ],

        // Panier

        'cart' => [
            'GET' => [
                'function' => 'showCart',
                'params' => []
            ]
        ],

        'addToCart' => [
            'POST' => [
                'function' => 'addToCart',
                'params' => [
                    'product_id',
                    'quantity'
                ]
            ]
        ],

        'updateCart' => [
            'POST' => [
                'function' => 'updateCart',
                'params' => [
                    'product_id',
                    'quantity'
                ]
            ]
        ],

        'removeFromCart' => [
            'POST' => [
                'function' => 'removeFromCart',
                'params' => [
                    'product_id'
                ]
            ]
        ],

        // Authentification

        'login' => [

            'GET' => [
                'function' => 'showLogin',
                'params' => []
            ],

            'POST' => [
                'function' => 'login',
                'params' => [
                    'email',
                    'password'
                ]
            ]
        ],

        'register' => [

            'GET' => [
                'function' => 'showRegister',
                'params' => []
            ],

            'POST' => [
                'function' => 'register',
                'params' => [
                    'name',
                    'email',
                    'address',
                    'password',
                    'password_confirm'
                ]
            ]
        ],

        'logout' => [
            'GET' => [
                'function' => 'logout',
                'params' => []
            ]
        ],

        // Produits

        'product' => [
            'GET' => [
                'function' => 'showProduct',
                'params' => [
                    'id'
                ]
            ]
        ],

        // Catalogue

        'catalogue' => [
            'GET' => [
                'function' => 'showCatalogue',
                'params' => []
            ]
        ],

        // Catégories

        'category' => [
            'GET' => [
                'function' => 'showCategory',
                'params' => [
                    'category_id'
                ]
            ]
        ],
    ];
}


function getRoute(): array
{
    /*
        Récupère la route demandée.

        Genre :
            ?action=product&id=15

        Retourne la route 'product'.

        S'il y a rien:
            -Remplacer par 'home'
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
        Vérifie si l'utilisateur peut accéder à la route.

        L'application nécessite une connexion,
        sauf pour les pages 'login' et 'register'.

        Si l'utilisateur n'est pas connecté,
        il est redirigé vers 'login'.

        Si l'utilisateur est déjà connecté
        et tente d'accéder à 'login' ou 'register'
        il est redirigé vers 'home'.
    */

    $is_logged = isset($_SESSION['id']);

    $routes = allRoutes();

    if (!$is_logged && !in_array($route['name'], ['login', 'register'], true)) {
        $route = $routes['login'];
        $route['name'] = 'login';
    }

    if ($is_logged && in_array($route['name'], ['login', 'register'], true)) {
        $route = $routes['home'];
        $route['name'] = 'home';
    }

    return $route;
}


function getRouteArguments(array $route): array
{
    /*
        Récupère les paramètres nécessaires à la route
        depuis GET ou POST selon la méthode HTTP.

        Genre :

        Route :
            'cartUpdate' => [
                'POST' => [
                    'function' => 'cartUpdate',
                    'params' => [
                        'product_id',
                        'quantity'
                    ]
                ]
            ]

        CRUD :
            POST

        Data :
            $_POST['product_id']
            $_POST['quantity']

        Résultat(en forme de tableau) :
            [
                $product_id,
                $quantity
            ]
    */

    $method = $_SERVER['REQUEST_METHOD'];

    if (!isset($route[$method])) {
        http_response_code(405);
        exit('Méthode non autorisée');
    }

    $params = $route[$method]['params'];

    $source = match ($method) {
        'GET' => $_GET,
        'POST' => $_POST,
        default => []
    };

    $args = [];

    foreach ($params as $param) {

        if (!isset($source[$param])) {
            exit("Le paramètre $param est manquant.");
        }

        $args[] = $source[$param];
    }

    return $args;
}


function executeRoute(array $route, array $args): void
{
    /*
        Exécute la fonction Controller associée
        à la méthode HTTP utilisée.
    */

    $method = $_SERVER['REQUEST_METHOD'];

    if (!isset($route[$method])) {
        http_response_code(405);
        exit('Méthode non autorisée');
    }

    $function = $route[$method]['function'];

    $function(...$args);
}