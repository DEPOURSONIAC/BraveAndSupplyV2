<?php

function addFavorite(int $user_id, int $product_id): bool
{
    /*
        Ajoute un produit
        aux favoris.
    */


    $db = getPDO();

    $added = false;

    if ($user_id > 0 && $product_id > 0) {

        try {

            $sql = "SELECT 1 FROM favorites WHERE user_id = ? AND product_id = ?";

            $stmt = $db->prepare($sql);
            $stmt->execute([$user_id, $product_id]);

            $exists = $stmt->fetch() !== false;

            if ($exists) {

                $added = true;

            } else {

                $sql = "
                    INSERT INTO favorites ( user_id, product_id) VALUES (?, ?)";

                $stmt = $db->prepare($sql);

                $added = $stmt->execute([$user_id, $noP]);
            }

        } catch (PDOException $e) {
            error_log(__FUNCTION__ . '(): ' . $e->getMessage());
        }
    }

    return $added;
}

function removeFavorite(int $user_id, int $product_id): bool
{
    /*
        Supprime un produit
        des favoris.
    */

    $db = getPDO();

    $removed = false;

    try {

        $sql = "DELETE FROM favorites WHERE user_id = ? AND product_id = ?";

        $stmt = $db->prepare($sql);

        $removed = $stmt->execute([$user_id, $product_id]);

    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $removed;
}

function getFavorites(int $user_id): array
{
    /*
        Retourne tous les favoris
        d'un utilisateur.
    */

    $db = getPDO();

    $sql = "SELECT p.* FROM favorites f INNER JOIN products p ON p.id = f.product_id WHERE f.user_id = ? ORDER BY f.id DESC";

    $stmt = $db->prepare($sql);
    $stmt->execute([$user_id]);

    $favorites = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $favorites;
}

function isFavorite(int $user_id, int $product_id): bool
{
    /*
        Vérifie si un produit
        est présent dans les favoris.
    */

    $db = getPDO();

    $sql = "SELECT 1 FROM favorites WHERE user_id = ? AND product_id = ?";

    $stmt = $db->prepare($sql);
    $stmt->execute([$user_id, $product_id]);

    $favorite = $stmt->fetch() !== false;

    return $favorite;
}