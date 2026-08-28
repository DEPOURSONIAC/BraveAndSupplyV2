<?php

function addReview(int $user_id, string $comment): bool
{
    /*
        Ajoute un avis.
    */

    $db = getPDO();

    try {
        $added = false;

        if ($user_id > 0 && !empty($comment)) {
            $sql = "INSERT INTO reviews (user_id, comment) VALUES (?, ?)";

            $stmt = $db->prepare($sql);

            $added = $stmt->execute([$user_id, $comment,]);
            
        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $added;
}

function deleteReview(int $review_id, int $user_id): bool
{
    /*
        Supprime un avis.

        Seul son auteur
        peut le supprimer.
    */

    $db = getPDO();

    try {
        $deleted = false;

        if ($review_id > 0 && $user_id > 0) {
            $sql = "DELETE FROM reviews WHERE id = ? AND user_id = ?";

            $stmt = $db->prepare($sql);

            $deleted = $stmt->execute([$review_id, $user_id,]);

        }
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

    try {
        $reviews = [];

        $sql = "SELECT r.*, u.name FROM reviews r INNER JOIN users u ON u.id = r.user_id ORDER BY r.created_at DESC";

        $stmt = $db->query($sql);

        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $reviews;
}

function getReviewsByUser(int $user_id): array
{
    /*
        Retourne tous les avis
        d'un utilisateur.

        Utilisé pour le compte.
    */

    $db = getPDO();

    try {
        $reviews = [];

        if ($user_id > 0) {
            $sql = "SELECT * FROM reviews WHERE user_id = ? ORDER BY id DESC";

            $stmt = $db->prepare($sql);
            $stmt->execute([$user_id]);

            $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $reviews;
}

function countReviewsByUser(int $user_id): int
{
    /*
        Compte le nombre d'avis
        d'un utilisateur.
    */

    $db = getPDO();

    try {
        $review_count = 0;

        if ($user_id > 0) {
            $sql = "SELECT COUNT(*) FROM reviews WHERE user_id = ?";

            $stmt = $db->prepare($sql);
            $stmt->execute([$user_id]);

            $review_count = (int) $stmt->fetchColumn();

        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $review_count;
}