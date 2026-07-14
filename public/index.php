<?php
// Chemin
define('BASE_URL', '/braveAndSupplyV2/'); 
/*  

    <?= BASE_URL ?>
    

    */

// Liens URL:   http://localhost/braveAndSupplyV2


/*
    Un mapping, c’est juste une “table de correspondance”.

        Idée simple

            Au lieu de dire :

            si c’est home - exécuter home_index()
            si c’est contact -> exécuter contact()
            si c’est about -> exécuter about()

            Stocker tout dans une structure :
                clé = action dans l’URL (?action=contact)
                valeur = fonction à appeler
*/

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../app/controllers/home.php";
require_once "../app/controllers/auth.php";
require_once "../app/controllers/product.php";


$action = $_GET['action'] ?? 'home';

$isLogged = isset($_SESSION['id']);


$routes = [

    'home' => [
        'fct' => 'home_index',
        'params' => []
    ],

    'contact' => [
        'fct' => 'contact',
        'params' => []
    ],

    'about' => [
        'fct' => 'about',
        'params' => []
    ],

    'login' => [
        'fct' => 'loginPage',
        'params' => []
    ],

    'logout' => [
        'fct' => 'logout',
        'params' => []
    ],

    'product' => [
        'fct' => 'showProduct',
        'params' => ['id']
    ],

    'register' => [
        'fct' => 'registerPage',
        'params' => []
],
];


// Login uniquement en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($action === 'login') {
        login();
        exit;
    }

    elseif ($action === 'register') {
        register();
        exit;
    }

}


// Protection connexion
if (!$isLogged && !in_array($action, ['login'])) {

    $action = 'login';
}


if ($isLogged && $action === 'login') {

    $action = 'home';
}


// Vérification route
if (!isset($routes[$action])) {

    http_response_code(404);
    exit('Page introuvable');
}


$route = $routes[$action];

$fct = $route['fct'];


// Vérifie que la fonction existe
if (!is_callable($fct)) {

    http_response_code(500);
    exit('Erreur serveur');
}


// Vérifie que la fonction existe
if (!is_callable($fct)) {

    http_response_code(500);
    exit('Erreur serveur');
}


$args = [];

foreach ($route['params'] as $param) {

    if ($param === 'id') {

        $id = $_GET['id'] ?? null;

        if (!is_numeric($id)) {
            http_response_code(400);
            exit('ID invalide');
        }

        $args[] = (int)$id;
    }
}


$fct(...$args);

