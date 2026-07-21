<?php

require_once MODEL_PATH . '/CartModel.php';

function createOrder(int $user_id, float $totalPrice, string $status = 'pending'): int
{
    /*
        Crée une nouvelle commande
        pour un utilisateur.
    */

    $db = getPDO();

    $sql = "INSERT INTO orders (user_id, total_price, status) VALUES (?, ?, ?) ";

    $stmt = $db->prepare($sql);

    $stmt->execute([$user_id, $totalPrice, $status]);

    $orderId = (int) $db->lastInsertId();

    return $orderId;
}


function addOrderItem(int $order_id, int $product_id, int $quantity, float $price): bool
{
    /*
        Ajoute un produit
        dans une commande.
    */

    $db = getPDO();

    $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?) ";

    $stmt = $db->prepare($sql);

    $added = $stmt->execute([$order_id, $product_id, $quantity, $price]);

    return $added;
}


function createOrderFromCart(int $user_id, string $status = 'pending'): ?int
{
    /*
        Transforme le panier utilisateur
        en commande complète.

        Création de la commande,
        ajout des produits puis
        suppression du panier.
    */

    $cart = getCart($user_id);

    $orderId = null;

    if (!empty($cart['products'])) {

        $orderId = createOrder($user_id, $cart['total'], $status);

        foreach ($cart['products'] as $product) {

            addOrderItem($orderId, $product['noP'], $product['quantity'], $product['price']);
        }

        clearCart($user_id);
    }

    return $orderId;
}


function getAllOrders(): array
{
    /*
        Retourne toutes les commandes.
        
        Utilisé principalement
        pour l'administration.
    */

    $db = getPDO();

    $sql = " SELECT * FROM orders ORDER BY id DESC ";

    $stmt = $db->query($sql);

    $orders = [];

    if ($stmt) {
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $orders;
}


function getOrderById(int $id): ?array
{
    /*
        Retourne une commande complète
        avec ses produits associés.
    */

    $db = getPDO();

    $orderDetails = null;

    $sql = "SELECT * FROM orders WHERE id = ?";

    $stmt = $db->prepare($sql);
    $stmt->execute([$noO]);

    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($order) {

        $sql = "SELECT oi.product_id, oi.quantity, oi.price, p.name, p.image FROM order_items oi INNER JOIN products p ON p.id = oi.product_id WHERE oi.order_items = ?";

        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $orderDetails = [
            'order' => $order,
            'items' => $items
        ];
    }

    return $orderDetails;
}


function getOrdersByUser(int $user_id): array
{
    /*
        Retourne toutes les commandes
        d'un utilisateur.
    */

    $db = getPDO();

    $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC";

    $stmt = $db->prepare($sql);
    $stmt->execute([$user_id]);

    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $orders;
}