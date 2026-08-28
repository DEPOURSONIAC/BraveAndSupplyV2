<?php

function getAllProducts(): array
{
    /*
        Retourne tous les produits.
    */

    $db = getPDO();

    try {
        $products = [];

        $sql = "SELECT * FROM products ORDER BY id DESC";

        $stmt = $db->query($sql);

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $products;
}

function getProductById(int $product_id): ?array
{
    /*
        Retourne un produit
        à partir de son identifiant.
    */

    $db = getPDO();

    try {
        $product = null;

        $sql = "SELECT * FROM products WHERE id = ? LIMIT 1";

        $stmt = $db->prepare($sql);
        $stmt->execute([$product_id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $product = $result ?: null;

    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $product;
}

function createProduct(int $category_id, string $name,string $description, float $price, float $stock, string $image): bool {
    /*
        Crée un nouveau produit.
    */

    $db = getPDO();

    try {
        $created = false;

        if ($category_id > 0 && !empty($name) && !empty($description) && $price > 0 && $stock > 0 && !empty($image)) {
            $sql = "INSERT INTO products (category_id, name, description, price, stock, image) VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = $db->prepare($sql);

            $created = $stmt->execute([$category_id, $name, $description, $price, $stock, $image,]);
        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $created;
}

function updateProduct(int $product_id, int $category_id, string $name, string $description, float $price, float $stock, string $image): bool {
    /*
        Met à jour un produit.
    */

    $db = getPDO();

    try {
        $updated = false;

        if ($product_id > 0 && $category_id > 0 && !empty($name) && !empty($description) && $price > 0 && $stock > 0 && !empty($image)) {
            $sql = "UPDATE products SET name = ?, description = ?, price = ?, stock = ?, image = ?, category_id = ? WHERE id = ?";

            $stmt = $db->prepare($sql);

            $updated = $stmt->execute([$name, $description, $price, $stock, $image, $category_id, $product_id,]);
        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $updated;
}

function deleteProduct(int $product_id): bool
{
    /*
        Supprime un produit.
    */

    $db = getPDO();

    try {
        $deleted = false;

        $sql = " DELETE FROM products WHERE id = ?";

        $stmt = $db->prepare($sql);

        $deleted = $stmt->execute([$product_id]);

    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $deleted;
}