<?php

function addToList(int $product_id, int $list_id): bool
{
    /*
        Ajoute un produit
        dans une liste.
    */

    $db = getPDO();

    try {
        $added = false;

        if ($product_id > 0 && $list_id > 0) {
            $sql = "INSERT INTO product_list_items ( product_id, list_id) VALUES (?, ?)";

            $stmt = $db->prepare($sql);

            $added = $stmt->execute([$product_id, $list_id,]);

        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $added;
}

function removeFromList(int $list_id, int $product_id): bool
{
    /*
        Retire un produit
        d'une liste.
    */

    $db = getPDO();

    try {
        $removed = false;

        if ($list_id > 0 && $product_id > 0) {
            $sql = "DELETE FROM product_list_items WHERE list_id = ? AND product_id = ?";

            $stmt = $db->prepare($sql);

            $removed = $stmt->execute([$list_id, $product_id,]);

        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $removed;
}

function createList(int $user_id, string $name): bool
{
    /*
        Crée une nouvelle liste
        pour un utilisateur.
    */

    $db = getPDO();

    try {
        $created = false;

        if ($user_id > 0 && !empty($name)) {
            $sql = "INSERT INTO product_lists ( user_id, name) VALUES (?, ?)";

            $stmt = $db->prepare($sql);

            $created = $stmt->execute([$user_id, $name,]);

        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $created;
}

function getList(int $user_id): array
{
    /*
        Retourne toutes les listes
        d'un utilisateur.
    */

    $db = getPDO();

    try {
        $lists = [];

        if ($user_id > 0) {
            $sql = "SELECT * FROM product_lists WHERE user_id = ?";

            $stmt = $db->prepare($sql);
            $stmt->execute([$user_id]);

            $lists = $stmt->fetchAll(PDO::FETCH_ASSOC);

        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $lists;
}

function getProductList(int $list_id): array
{
    /*
        Retourne tous les produits
        d'une liste.
    */

    $db = getPDO();

    try {
        $products = [];

        if ($list_id > 0) {
            $sql = "SELECT p.* FROM products p INNER JOIN product_list_items pli ON p.id = pli.product_id WHERE pli.list_id = ?";

            $stmt = $db->prepare($sql);
            $stmt->execute([$list_id]);

            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $products;
}

function deleteList(int $user_id, int $list_id): bool
{
    /*
        Supprime une liste
        d'un utilisateur.
    */

    $db = getPDO();

    try {
        $deleted = false;

        if ($user_id > 0 && $list_id > 0) {
            $sql = "DELETE FROM product_lists WHERE user_id = ? AND id = ?";

            $stmt = $db->prepare($sql);

            $deleted = $stmt->execute([$user_id, $list_id,]);

        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $deleted;
}