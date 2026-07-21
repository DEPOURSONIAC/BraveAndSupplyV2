<?php

function getAllCategories(): array
{
    /*
        Retourne toutes les catégories.
    */

    $db = getPDO();

    $sql = "SELECT * FROM categories ORDER BY id ASC";

    $stmt = $db->query($sql);

    $categories = [];

    if ($stmt) {
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $categories;
}

function getCategoryById(int $id): ?array
{
    /*
        Retourne une catégorie
        à partir de son identifiant.
    */

    $db = getPDO();

    $sql = "SELECT * FROM categories WHERE id = ? LIMIT 1 ";

    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $category = $result ?: null;

    return $category;
}

function getProductsByCategory(int $category_id): array
{
    /*
        Retourne tous les produits
        d'une catégorie.
    */

    $db = getPDO();

    $sql = "SELECT * FROM products WHERE category_id = ? ORDER BY id DESC ";

    $stmt = $db->prepare($sql);
    $stmt->execute([$category_id]);

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $products;
}

function createCategory(string $name): bool
{
    /*
        Crée une nouvelle catégorie.
    */

    $db = getPDO();

    $created = false;

    if (!empty($name)) {

        try {

            $sql = "INSERT INTO categories (name) VALUES (?)";

            $stmt = $db->prepare($sql);

            $created = $stmt->execute([$name]);

        } catch (PDOException $e) {
            error_log(__FUNCTION__ . '(): ' . $e->getMessage());
        }
    }

    return $created;
}

function updateCategory(int $id, string $name): bool
{
    /*
        Met à jour une catégorie.
    */

    $db = getPDO();

    $updated = false;

    if (!empty($name)) {

        try {

            $sql = " UPDATE categories SET name = ? WHERE id = ?";

            $stmt = $db->prepare($sql);

            $updated = $stmt->execute([$name, $id]);

        } catch (PDOException $e) {
            error_log(__FUNCTION__ . '(): ' . $e->getMessage());
        }
    }

    return $updated;
}

function deleteCategory(int $id): bool
{
    /*
        Supprime une catégorie.
    */

    $db = getPDO();

    $deleted = false;

    try {

        $sql = "DELETE FROM categories WHERE id = ?";

        $stmt = $db->prepare($sql);

        $deleted = $stmt->execute([$id]);

    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $deleted;
}