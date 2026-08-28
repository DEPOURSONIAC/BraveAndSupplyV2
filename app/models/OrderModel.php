<?php

function createOrder(int $user_id, float $total_price, string $status = 'pending'): int 
{
    /*
        Crée une nouvelle commande
        pour un utilisateur.
    */

    $db = getPDO();

    try {
        $order_id = 0;

        if ($user_id > 0 && $total_price >= 0 && !empty($status)) {

            $sql = "INSERT INTO orders ( user_id, total_price, status) VALUES (?, ?, ?)";

            $stmt = $db->prepare($sql);

            $created = $stmt->execute([$user_id, $total_price, $status,]);

            if ($created) {
                $order_id = (int) $db->lastInsertId();
            }
        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $order_id;
}

function addOrderItem(int $order_id, int $product_id, int $quantity, float $price): bool 
{
    /*
        Ajoute un produit
        dans une commande.
    */

    $db = getPDO();

    try {
        $added = false;

        if ($order_id > 0 && $product_id > 0 && $quantity > 0 && $price >= 0) {
            $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";

            $stmt = $db->prepare($sql);

            $added = $stmt->execute([ $order_id, $product_id, $quantity, $price,]);

        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $added;
}

function createOrderFromCart(int $user_id,string $status = 'pending'): ?int 
{
    /*
        Transforme le panier utilisateur
        en commande complète.

        Création de la commande,
        ajout des produits puis
        suppression du panier.
    */

    try {
        $order_id = null;

        if ($user_id > 0) {
            $cart = getCart($user_id);

            if (!empty($cart['products'])) {
                $order_id = createOrder($user_id, $cart['total'], $status);

                if ($order_id > 0) {

                    foreach ($cart['products'] as $product) {
                        addOrderItem($order_id, (int) $product['id'], (int) $product['quantity'], (float) $product['price']);
                    }

                    clearCart($user_id);
                }
            }
        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $order_id;
}

function getAllOrders(): array
{
    /*
        Retourne toutes les commandes.

        Utilisé principalement
        pour l'administration.
    */

    $db = getPDO();

    try {
        $orders = [];

        $sql = "SELECT * FROM orders ORDER BY id DESC
        ";

        $stmt = $db->query($sql);

        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $orders;
}

function getOrderById(int $order_id, int $user_id): ?array
{
    /*
        Retourne une commande complète
        avec ses produits associés.
    */

    $db = getPDO();

    try {
        $order_details = null;

        if ($order_id > 0 && $user_id > 0) {
            $sql = "SELECT * FROM orders WHERE id = ? AND user_id = ?";

            $stmt = $db->prepare($sql);
            $stmt->execute([$order_id, $user_id]);

            $order = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($order) {
                $sql = "SELECT oi.product_id, oi.quantity, oi.price, p.name, p.image FROM order_items oi INNER JOIN products p ON p.id = oi.product_id WHERE oi.order_id = ? ";

                $stmt = $db->prepare($sql);
                $stmt->execute([$order_id]);

                $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $order_details = [
                    'order' => $order,
                    'items' => $items,
                ];
            }
        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $order_details;
}

function getOrdersByUser(int $user_id): array
{
    /*
        Retourne toutes les commandes
        d'un utilisateur.
    */

    $db = getPDO();

    try {
        $orders = [];

        if ($user_id > 0) {
            $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC";

            $stmt = $db->prepare($sql);
            $stmt->execute([$user_id]);

            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $orders;
}

function countOrdersByUser(int $user_id): int
{
    /*
        Retourne le nombre
        de commandes d'un utilisateur.
    */

    $db = getPDO();

    try {
        $order_count = 0;

        if ($user_id > 0) {
            $sql = "SELECT COUNT(*) FROM orders WHERE user_id = ?";

            $stmt = $db->prepare($sql);
            $stmt->execute([$user_id]);

            $order_count = (int) $stmt->fetchColumn();

        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $order_count;
}