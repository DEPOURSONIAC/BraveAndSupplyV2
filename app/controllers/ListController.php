<?php

function showLists(): void
{
    /*
        Affiche les listes de l'utilisateur.

        Cette section est destinée à être chargée dynamiquement(AJAX)
        depuis la page du compte.
    */

    $user = getCurrentUser();
    $user_id = (int) $user['id'];

    $lists = getLists($user_id);

    view('user/account/lists', [
        'lists' => $lists,
    ]);
}

function showList(int $list_id): void
{
    /*
        Affiche les produits d'une liste
        de l'utilisateur connecté.
    */

    $user = getCurrentUser();
    $user_id = (int) $user['id'];

    if ($list_id <= 0) {
        http_response_code(400);
        exit('Identifiant de liste invalide.');
    }

    $products = getProductList($user_id, $list_id);

    view('user/account/list', [
        'products' => $products,
        'list_id' => $list_id,
    ]);
}

function createList(string $name): void
{
    /*
        Crée une nouvelle liste
        pour l'utilisateur connecté.
    */

    $user = getCurrentUser();
    $user_id = (int) $user['id'];

    $name = trim($name);

    if ($name === '') {
        http_response_code(400);
        exit('Nom de liste invalide.');
    }

    $created = insertList($user_id, $name);

    if (!$created) {
        http_response_code(500);
        exit('Impossible de créer la liste.');
    }
}

function deleteList(int $list_id): void
{
    /*
        Supprime une liste de l'utilisateur connecté.
    */

    $user = getCurrentUser();
    $user_id = (int) $user['id'];

    if ($list_id <= 0) {
        http_response_code(400);
        exit('Identifiant de liste invalide.');
    }

    $deleted = removeList($user_id, $list_id);

    if (!$deleted) {
        http_response_code(500);
        exit('Impossible de supprimer la liste.');
    }
}

function addToList(int $product_id, int $list_id): void
{
    /*
        Ajoute un produit dans une liste
        de l'utilisateur connecté.
    */

    $user = getCurrentUser();
    $user_id = (int) $user['id'];

    if ($product_id <= 0 || $list_id <= 0) {
        http_response_code(400);
        exit('Identifiant invalide.');
    }

    $added = insertProductInList($user_id, $product_id, $list_id);

    if (!$added) {
        http_response_code(500);
        exit("Impossible d'ajouter le produit à la liste.");
    }
}

function removeFromList(int $product_id, int $list_id): void
{
    /*
        Retire un produit d'une liste
        de l'utilisateur connecté.
    */

    $user = getCurrentUser();
    $user_id = (int) $user['id'];

    if ($product_id <= 0 || $list_id <= 0) {
        http_response_code(400);
        exit('Identifiant invalide.');
    }

    $removed = removeFromList($user_id, $list_id, $product_id);

    if (!$removed) {
        http_response_code(500);
        exit('Impossible de retirer le produit de la liste.');
    }
}