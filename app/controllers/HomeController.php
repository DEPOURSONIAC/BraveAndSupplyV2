<?php

function showHome(): void
{
    /*
        Affiche la page d'accueil.

        Récupère les produits des différentes
        catégories puis charge la vue.
    */

    $hommes = getProductsByCategory(CATEGORY_HOMME);
    $femmes = getProductsByCategory(CATEGORY_FEMME);
    $kids = getProductsByCategory(CATEGORY_KIDS);

    $reviews = getAllReviews();

    view('home', [ 
        'hommes' => $hommes, 
        'femmes' => $femmes, 
        'kids' => $kids, 
        'reviews' => $reviews ]); 

}


function showContact(): void
{
    /*
        Affiche la page de contact.
    */

    view('annex/contact');
}

function showAbout(): void
{
    /*
        Affiche la page à propos.
    */

    view('annex/about');
}