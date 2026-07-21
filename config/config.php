<?php

// --------------------
// Chemins du projet
// --------------------

define('ROOT', dirname(__DIR__));

define('APP_PATH', ROOT . '/app');
define('MODEL_PATH', APP_PATH . '/models');
define('VIEW_PATH', APP_PATH . '/views');
define('CONTROLLER_PATH', APP_PATH . '/controllers');
define('INCLUDE_PATH', ROOT . '/includes');
define('PUBLIC_PATH', ROOT . '/public');

// URL
define('BASE_URL', '/braveAndSupplyV2/');

// BDD
define('DB_PATH', ROOT . '/config/braveandsupplyv2.db');


// --------------------
// Catégories
// --------------------

define("CATEGORY_HOMME", 1);
define("CATEGORY_FEMME", 2);
define("CATEGORY_KIDS", 3);
