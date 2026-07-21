<?php

function getOrCreateCart(int $user_id): int
{
    /*
        Retourne le panier de l'utilisateur.

        Si aucun panier n'existe,
        il est créé.
    */

    $db = getPDO();

    $id = 0;

    $sql = " SELECT id FROM carts WHERE user_id = ? "; 

    $stmt = $db->prepare($sql);
    $stmt->execute([$user_id]);

    $cart = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cart) {

        $id = (int) $cart['id'];

    } else {

        $sql = "INSERT INTO carts (id) VALUES (?)";

        $stmt = $db->prepare($sql);
        $stmt->execute([$user_id]);

        $id = (int) $db->lastInsertId();
    }

    return $id;
}

function addToCart(int $user_id, int $product_id, int $quantity = 1): bool
{
    /*
        Ajoute un produit au panier.

        Si le produit est déjà présent,
        sa quantité est augmentée.
    */

    $db = getPDO();

    $added = false;

    $cart_id = getOrCreateCart(user_id);

    $sql = " SELECT quantity FROM cart_items WHERE cart_id = ? AND product_id = ? ";

    $stmt = $db->prepare($sql);
    $stmt->execute([$cart_id, $product_id]);

    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {

        $sql = "UPDATE cart_items SET quantity = quantity + ? WHERE cart_id = ? AND product_id = ?";

        $stmt = $db->prepare($sql);

        $added = $stmt->execute([$quantity, $cart_id, $product_id]);

    } else {

        $sql = "INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)";

        $stmt = $db->prepare($sql);

        $added = $stmt->execute([$cart_id, $product_id, $quantity]);
    }

    return $added;
}

function getCart(int $user_id): array
{
    /*
        Retourne le contenu du panier
        ainsi que son montant total.
    */

    $db = getPDO();

    $cart = [
        'products' => [],
        'total' => 0
    ];

    $sql = "SELECT id FROM carts WHERE user_id= ? ";

    $stmt = $db->prepare($sql);
    $stmt->execute([$user_id]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {

        $sql = "SELECT p.id, ci.quantity, p.name, p.image, p.price, (p.price * ci.quantity) AS totalByProduct FROM cart_items ci INNER JOIN products p ON p.id = ci.product_id WHERE ci.cart_id = ?";

        $stmt = $db->prepare($sql);
        $stmt->execute([$result['id']]);

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $total = 0;

        foreach ($products as $product) {
            $total += $product['totalByProduct'];
        }

        $cart = [
            'products' => $products,
            'total' => $total
        ];
    }

    return $cart;
}

function removeFromCart(int $user_id, int $product_id): bool
{
    /*
        Supprime un produit
        du panier.
    */

    $db = getPDO();

    $sql = "DELETE FROM cart_items WHERE cart_id = (SELECT id FROM carts WHERE user_id = ?) AND product_id = ?";

    $stmt = $db->prepare($sql);

    $removed = $stmt->execute([$user_id, $product_id]);

    return $removed;
}

function clearCart(int $user_id): bool
{
    /*
        Supprime tous les produits
        du panier.
    */

    $db = getPDO();

    $sql = "DELETE FROM cart_items WHERE cart_id = ( SELECT id FROM carts WHERE user_id = ?)";

    $stmt = $db->prepare($sql);

    $cleared = $stmt->execute([$user_id]);

    return $cleared;
}