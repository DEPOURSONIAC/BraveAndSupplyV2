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

function showCategory(int $id): void
{
    /*
        Affiche les produits en fct de la categorie
    */

    $products = getProductsByCategory($id);

    if ($id <= 0) {
        http_response_code(400);
        exit('Identifiant invalide.');
    }

    $product = getProductById($id);

    if (!$product) {
        http_response_code(404);
        exit('Categorie introuvable.');
    }

    view('shop/category', [
        'products' => $products
        
        ]);
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

    view('shop/product', [
        'product' => $product
        
        ]);
}