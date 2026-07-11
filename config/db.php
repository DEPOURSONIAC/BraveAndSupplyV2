<?php

$config = require 'config.php';

$dbConfig = $config['db'];

try {
    $db = new PDO("sqlite:{$dbConfig['chemin']}");

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // TEST
    // echo 'BDD okay.';

} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}