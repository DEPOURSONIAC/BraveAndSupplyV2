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

    view('home', [
        'hommes' => $hommes,
        'femmes' => $femmes,
        'kids' => $kids
    ]);
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