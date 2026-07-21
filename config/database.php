<?php

function getPDO(): PDO
{
    /*
        Retourne la connexion à la base de données.
        Si elle existe déjà, on réutilise la même.
        (On gagne du temps)
    */

    static $pdo = null;

    if ($pdo === null) {

        $pdo = new PDO('sqlite:' . DB_PATH);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    // TEST
    // echo 'BDD okay.';

    return $pdo;
}