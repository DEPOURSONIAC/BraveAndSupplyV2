<?php
function getCurrentUser(): array
{
    /*
        Récupère l'utilisateur actuellement connecté.

        Redirige vers l'accueil si aucun utilisateur n'est connecté
        ou si l'utilisateur n'existe plus en base de données.
    */

    if (!isset($_SESSION['id'])) {
        redirect('home');
    }

    $user = getUserById((int) $_SESSION['id']);

    if (!$user) {
        redirect('home');
    }

    return $user;
}


function getUserStats(int $userId): array
{
    /*
        Récupère les statistiques de l'utilisateur.
    */
    return [
        'orderCount'  => countOrdersByUser($userId),
        'cartCount'   => countProductInCartByUser($userId),
        'reviewCount' => countReviewsByUser($userId),
    ];
}


function accountPage(): void
{
    /*
        Affiche la page complète du compte utilisateur.
    */

    $user = getCurrentUser();
    $userId = (int) $user['id'];

    $stats = getUserStats($userId);
    $orders = getOrdersByUser($userId);

    view('user/account', [
        'user'        => $user,
        'orderCount'  => $stats['orderCount'],
        'cartCount'   => $stats['cartCount'],
        'reviewCount' => $stats['reviewCount'],
        'orders'      => $orders,
    ]);
}


function profile(): void
{
    /*
        Renvoie uniquement le contenu du profil
        pour du AJAX.
    */

    $user = getCurrentUser();
    $userId = (int) $user['id'];

    $stats = getUserStats($userId);
    $orders = getOrdersByUser($userId);

    view('user/account/profile', [
        'user'        => $user,
        'orderCount'  => $stats['orderCount'],
        'cartCount'   => $stats['cartCount'],
        'reviewCount' => $stats['reviewCount'],
        'orders'      => $orders,
    ]);
}

function cart(): void
{
    /*
        Affiche le panier de l'utilisateur.
    */

    $user = getCurrentUser();
    $userId = (int) $user['id'];

    $stats = getUserStats($userId);
    $cart = getCart($userId);

    view('user/account/cart', [
        'user'      => $user,
        'cart'      => $cart,
        'cartCount'   => $stats['cartCount'],
    ]);
}

function orders(): void
{
    /*
        Affiche les commandes de l'utilisateur.
    */

    $user = getCurrentUser();
    $userId = (int) $user['id'];

    $stats = getUserStats($userId);
    $orders = getOrdersByUser($userId);

    view('user/account/orders', [
        'user'        => $user,
        'orderCount'  => $stats['orderCount'],
        'cartCount'   => $stats['cartCount'],
        'reviewCount' => $stats['reviewCount'],
        'orders'      => $orders,
    ]);
}

function reviews(): void
{
    /*
    Affiche les avis de l'utilisateur.
    */

    $user = getCurrentUser();
    $userId = (int) $user['id'];

    $reviews = getReviewsByUser($userId);

    view('user/account/reviews', [
        'user'    => $user,
        'reviews' => $reviews,
    ]);
}
