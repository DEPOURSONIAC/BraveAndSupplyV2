<?php

function addToCart(int $product_id, int $quantity = 1): void
{
    /*
        Ajoute un produit au panier de l'utilisateur
        puis le redirige vers la page du produit.
    */

    if ($quantity < 1) {
        redirect("product&id=$product_id&OK=FALSE");
    }

    $user = getCurrentUser();
    $user_id = (int) $user['id'];

    $added = insertCartItem($user_id, $product_id, $quantity);

    if ($added) {
        redirect("product&id=$product_id&OK=TRUE");
    }

    redirect("product&id=$product_id&OK=FALSE");
}

function updateCart(int $product_id, int $quantity): void
{
    /*
        Met à jour la quantité d'un produit dans le panier.
    */

    if ($quantity < 1) {
        echo json_encode([
            'success' => false,
        ]);
        return;
    }

    $user = getCurrentUser();
    $user_id = (int) $user['id'];

    $updated = updateCartItemQuantity($user_id, $product_id, $quantity);

    $stats = getUserStats($user_id);
    $cart = getCart($user_id);

    echo json_encode([
        'success'    => $updated,
        'cart'       => $cart,
        'cart_count' => $stats['cart_count'],
    ]);
}

function removeFromCart(int $product_id): void
{
    /*
        Supprime un produit du panier de l'utilisateur.
    */

    $user = getCurrentUser();
    $user_id = (int) $user['id'];

    $removed = deleteCartItem($user_id, $product_id);

    $stats = getUserStats($user_id);
    $cart = getCart($user_id);

    echo json_encode([
        'success'    => $removed,
        'cart'       => $cart,
        'cart_count' => $stats['cart_count'],
    ]);
}

function showCart(): void
{
    /*
        Affiche le panier de l'utilisateur.
    */

    $user = getCurrentUser();
    $user_id = (int) $user['id'];

    $stats = getUserStats($user_id);
    $cart = getCart($user_id);

    view('user/account/cart', [
        'cart'       => $cart,
        'cart_count' => $stats['cart_count'],
    ]);
}