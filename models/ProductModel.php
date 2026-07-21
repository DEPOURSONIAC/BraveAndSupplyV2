<?php

function getAllProducts(): array
{
    /*
        Retourne tous les produits.
    */

    $db = getPDO();

    $sql = "SELECT * FROM products ORDER BY id DESC";

    $stmt = $db->query($sql);

    $products = [];

    if ($stmt) {
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $products;
}

function getProductsByCategory(int $id): ?array
{
    /*
        Retourne un produit
        à partir de son identifiant.
    */

    $db = getPDO();

    $sql = "SELECT * FROM products WHERE id = ? LIMIT 1";

    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $product = $result ?: null;

    return $product;
}

function createProduct(int $category_id, string $name, string $description, float $price,float $stock, string $image): bool
{
    /*
        Crée un nouveau produit.
    */

    $db = getPDO();

    $created = false;

    if ($category_id > 0 && !empty($name) && !empty($description) && $price > 0 && $stock > 0 && !empty($image)) {

        try {

            $sql = "INSERT INTO products (category_id, name, description, price, stock, image) VALUES (?, ?, ?, ?, ?)";

            $stmt = $db->prepare($sql);

            $created = $stmt->execute([$category_id, $name, $description, $price, $stock, $image]);

        } catch (PDOException $e) {
            error_log(__FUNCTION__ . '(): ' . $e->getMessage());
        }
    }

    return $created;
}

function updateProduct(int $id, int $category_id, string $name, string $description, float $price, float $stock, string $image): bool
{
    /*
        Met à jour un produit.
    */

    $db = getPDO();

    $updated = false;

    if ( $id > 0 && $category_id > 0 && !empty($name) && !empty($description) && price > 0 && $stock > 0 && !empty($image)) {

        try {

            $sql = " UPDATE products SET name = ?, description = ?, price = ?,  stock = ?, image = ?, category_id = ? WHERE id = ?";

            $stmt = $db->prepare($sql);

            $updated = $stmt->execute([$name, $description, $price, $stock, $image, $category_id, $id]);

        } catch (PDOException $e) {
            error_log(__FUNCTION__ . '(): ' . $e->getMessage());
        }
    }

    return $updated;
}

function deleteProduct(int $id): bool
{
    /*
        Supprime un produit.
    */

    $db = getPDO();

    $deleted = false;

    try {

        $sql = "DELETE FROM products WHERE id = ?";

        $stmt = $db->prepare($sql);

        $deleted = $stmt->execute([$id]);

    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $deleted;
}

