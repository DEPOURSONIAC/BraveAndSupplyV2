<?php

require_once MODEL_PATH . '/ProductModel.php';


function showCatalogue(): void
{
    /*
        Affiche le catalogue.
    */

    $products = getAllProducts();

    view('shop/catalogue');
}


function showProduct(int $id): void
{
    /*
        Affiche un produit.
    */

    if ($id <= 0) {
        http_response_code(400);
        exit('Identifiant invalide.');
    }

    $product = getProductById($id);

    if (!$product) {
        http_response_code(404);
        exit('Produit introuvable.');
    }

    view('shop/product');
}