<?php

function createReview(string $comment): void
{
    /*
        Crée un nouvel avis
        pour l'utilisateur connecté.
    */

    $user = getCurrentUser();
    $user_id = (int) $user['id'];

    $comment = trim($comment);

    $success = false;

    if ($comment !== '') {

        $added = addReview($user_id, $comment);

        if ($added) {
            $success = true;
        }
    }

    redirect('account');
}

function removeReview(int $review_id): void
{
    /*
        Supprime un avis
        de l'utilisateur connecté.
    */

    $user = getCurrentUser();
    $user_id = (int) $user['id'];

    $success = false;

    if ($review_id > 0) {

        $deleted = deleteReview($review_id, $user_id);

        if ($deleted) {
            $success = true;
        }
    }

    redirect('account');
}