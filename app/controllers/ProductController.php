<?php

function showCatalogue(): void
{
    /*
        Affiche le catalogue.
    */

    $products = getAllProducts();

    view('shop/catalogue', [
        'products' => $products
    ]);
}

function showCategory(int $category_id): void
{
    /*
        Affiche les produits d'une catégorie.
    */

    if ($category_id <= 0) {
        http_response_code(400);
        exit('Identifiant de catégorie invalide.');
    }

    $products = getProductsByCategory($category_id);

    if (!$products) {
        http_response_code(404);
        exit('Catégorie introuvable.');
    }

    view('shop/category', [
        'products' => $products
    ]);
}

function showProduct(int $product_id): void
{
    /*
        Affiche un produit.
    */

    if ($product_id <= 0) {
        http_response_code(400);
        exit('Identifiant de produit invalide.');
    }

    $product = getProductById($product_id);

    if (!$product) {
        http_response_code(404);
        exit('Produit introuvable.');
    }

    view('shop/product', [
        'product' => $product
    ]);
}