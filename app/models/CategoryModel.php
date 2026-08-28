<?php

function getAllCategories(): array
{
    /*
        Retourne toutes les catégories.
    */

    $db = getPDO();

    try {
        $categories = [];

        $sql = "SELECT * FROM categories ORDER BY id ASC";

        $stmt = $db->query($sql);

        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $categories;
}

function getCategoryById(int $category_id): ?array
{
    /*
        Retourne une catégorie
        à partir de son identifiant.
    */

    $db = getPDO();

    try {
        $category = null;

        $sql = "SELECT * FROM categories WHERE id = ? LIMIT 1";

        $stmt = $db->prepare($sql);
        $stmt->execute([$category_id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $category = $result ?: null;

    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $category;
}

function createCategory(string $name): bool
{
    /*
        Crée une nouvelle catégorie.
    */

    $db = getPDO();

    try {
        $created = false;

        if (!empty($name)) {
            $sql = "INSERT INTO categories (name) VALUES (?)";

            $stmt = $db->prepare($sql);

            $created = $stmt->execute([$name]);
        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $created;
}

function updateCategory(int $category_id, string $name): bool
{
    /*
        Met à jour une catégorie.
    */

    $db = getPDO();

    try {
        $updated = false;

        if (!empty($name)) {
            $sql = "UPDATE categories SET name = ? WHERE id = ?";

            $stmt = $db->prepare($sql);

            $updated = $stmt->execute([$name, $category_id,]);

        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $updated;
}

function deleteCategory(int $category_id): bool
{
    /*
        Supprime une catégorie.
    */

    $db = getPDO();

    try {
        $deleted = false;

        $sql = "DELETE FROM categories WHERE id = ?";

        $stmt = $db->prepare($sql);

        $deleted = $stmt->execute([$category_id]);

    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $deleted;
}

function getProductsByCategory(int $category_id): array
{
    /*
        Retourne tous les produits
        d'une catégorie.
    */

    $db = getPDO();

    try {
        $products = [];

        $sql = "SELECT * FROM products WHERE category_id = ? ORDER BY id DESC";

        $stmt = $db->prepare($sql);
        $stmt->execute([$category_id]);

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $products;
}