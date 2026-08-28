<?php

function getOrCreateCart(int $user_id): int
{
    /*
        Retourne le panier de l'utilisateur.

        Si aucun panier n'existe,
        il est créé.
    */

    $db = getPDO();

    try {
        $cart_id = 0;

        $sql = "SELECT id FROM carts WHERE user_id = ?";

        $stmt = $db->prepare($sql);
        $stmt->execute([$user_id]);

        $cart = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cart) {
            $cart_id = (int) $cart['id'];
        } else {
            $sql = "INSERT INTO carts (user_id) VALUES (?)";

            $stmt = $db->prepare($sql);
            $stmt->execute([$user_id]);

            $cart_id = (int) $db->lastInsertId();

        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $cart_id;
}

function insertCartItem(int $user_id, int $product_id, int $quantity = 1): bool 
{
    /*
        Ajoute un produit au panier.

        Si le produit est déjà présent,
        sa quantité est augmentée.
    */

    $db = getPDO();

    try {
        $added = false;

        if ($user_id > 0 && $product_id > 0 && $quantity > 0) {
            $cart_id = getOrCreateCart($user_id);

            if ($cart_id > 0) {
                $sql = "SELECT quantity FROM cart_items WHERE cart_id = ? AND product_id = ?";

                $stmt = $db->prepare($sql);
                $stmt->execute([$cart_id, $product_id,]);

                $item = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($item) {
                    $sql = "UPDATE cart_items SET quantity = quantity + ? WHERE cart_id = ? AND product_id = ?";

                    $stmt = $db->prepare($sql);

                    $added = $stmt->execute([$quantity, $cart_id, $product_id,]);
                } else {
                    $sql = "INSERT INTO cart_items (cart_id,product_id, quantity) VALUES (?, ?, ?)";

                    $stmt = $db->prepare($sql);

                    $added = $stmt->execute([$cart_id, $product_id, $quantity,]);
                }
            }
        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
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

    try {
        $cart = [
            'products' => [],
            'total' => 0,
        ];

        if ($user_id > 0) {
            $sql = "SELECT id FROM carts WHERE user_id = ?";

            $stmt = $db->prepare($sql);
            $stmt->execute([$user_id]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $sql = "SELECT p.id, ci.quantity, p.name, p.image, p.price,(p.price * ci.quantity) AS total_by_product FROM cart_items ci INNER JOIN products p ON p.id = ci.product_id WHERE ci.cart_id = ?";

                $stmt = $db->prepare($sql);
                $stmt->execute([$result['id']]);

                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $total = 0;

                foreach ($products as $product) {
                    $total += $product['total_by_product'];
                }

                $cart = [
                    'products' => $products,
                    'total' => $total,
                ];
            }
        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $cart;
}

function deleteCartItem(int $user_id, int $product_id): bool
{
    /*
        Supprime un produit du panier.
    */

    $db = getPDO();

    try {
        $deleted = false;

        if ($user_id > 0 && $product_id > 0) {
            $sql = "DELETE FROM cart_items WHERE cart_id = (SELECT id FROM carts WHERE user_id = ?) AND product_id = ?";

            $stmt = $db->prepare($sql);

            $deleted = $stmt->execute([$user_id, $product_id,]);

        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $deleted;
}

function clearCart(int $user_id): bool
{
    /*
        Supprime tous les produits du panier.
    */

    $db = getPDO();

    try {
        $cleared = false;

        if ($user_id > 0) {
            $sql = "DELETE FROM cart_items WHERE cart_id = (SELECT id FROM carts WHERE user_id = ?)d";

            $stmt = $db->prepare($sql);

            $cleared = $stmt->execute([$user_id]);

        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $cleared;
}

function countProductInCartByUser(int $user_id): int
{
    /*
        Compte la quantité totale de produits
        dans le panier de l'utilisateur.
    */

    $db = getPDO();

    try {
        $product_count = 0;

        if ($user_id > 0) {
            $sql = "SELECT COALESCE(SUM(cart_items.quantity), 0) FROM cart_items INNER JOIN carts ON cart_items.cart_id = carts.id WHERE carts.user_id = ?";

            $stmt = $db->prepare($sql);
            $stmt->execute([$user_id]);

            $product_count = (int) $stmt->fetchColumn();
        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $product_count;
}

function updateCartItemQuantity(int $user_id, int $product_id, int $quantity): bool {
    /*
        Met à jour la quantité d'un produit
        dans le panier de l'utilisateur.
    */

    $db = getPDO();

    try {
        $updated = false;

        if ($user_id > 0 && $product_id > 0 && $quantity > 0) {
            $sql = "UPDATE cart_items SET quantity = ? WHERE cart_id = (SELECT id FROM carts WHERE user_id = ?) AND product_id = ?";

            $stmt = $db->prepare($sql);

            $updated = $stmt->execute([$quantity, $user_id, $product_id,]);

        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $updated;
}