<?php

function addReview(int $user_id, string $comment): bool
{
    /*
        Ajoute un avis
        sur un produit.
    */

    $db = getPDO();

    $added = false;

    if (
        $user_id > 0 && !empty($comment)) {

        try {

            $sql = "INSERT INTO reviews (user_id, comment) VALUES (?, ?)";

            $stmt = $db->prepare($sql);

            $added = $stmt->execute([$user_id, $comment]);

        } catch (PDOException $e) {
            error_log(__FUNCTION__ . '(): ' . $e->getMessage());
        }
    }

    return $added;
}

function deleteReview(int $id, int $user_id): bool
{
    /*
        Supprime un avis.

        Seul son auteur
        peut le supprimer.
    */

    $db = getPDO();

    $deleted = false;

    try {

        $sql = "DELETE FROM reviews WHERE id = ? AND user_id = ?";

        $stmt = $db->prepare($sql);

        $deleted = $stmt->execute([$id, $user_id]);

    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $deleted;
}

function getAllReviews(): array
{
    /*
        Retourne tous les avis.

        Utilisé pour l'administration.
    */

    $db = getPDO();

    $sql = "SELECT r.*, u.name FROM reviews r INNER JOIN users u ON u.id = r.user_id ORDER BY r.created_at DESC ";

    $stmt = $db->query($sql);

    $reviews = [];

    if ($stmt) {
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $reviews;
}