<?php
function home(): void
{
    /*
        Affiche la page d'accueil.

        Récupère les produits des différentes
        catégories puis charge la vue.
    */

    $hommes = getProductsByCategory(CATEGORY_HOMME);
    $femmes = getProductsByCategory(CATEGORY_FEMME);
    $kids   = getProductsByCategory(CATEGORY_KIDS);

    view("home", [
        'hommes' => $hommes,
        'femmes' => $femmes,
        'kids'   => $kids
    ]);
}


function contact(): void
{
    /*
        Affiche la page de contact.
    */

    view("annex/contact");
}


function about(): void
{
    /*
        Affiche la page à propos.
    */

    view("annex/about");
}