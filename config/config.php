<?php

/*
    Project configuration.

    Contains:
    - Project paths
    - Application URL
    - Database configuration
    - Application constants
*/


// --------------------
// PROJECT ROOT
// --------------------

define('ROOT', dirname(__DIR__));

define('APP_PATH', ROOT . '/app');
define('MODEL_PATH', APP_PATH . '/models');
define('VIEW_PATH', APP_PATH . '/views');
define('CONTROLLER_PATH', APP_PATH . '/controllers');

define('INCLUDE_PATH', ROOT . '/includes');
define('PUBLIC_PATH', ROOT . '/public');


// --------------------
// URL
// --------------------

define('BASE_URL', '/brave_and_supply/');


// --------------------
// DATABASE
// --------------------

define('DB_PATH', ROOT . '/config/brave_and_supply');


// --------------------
// CATEGORIES
// --------------------

define('CATEGORY_HOMME', 1);
define('CATEGORY_FEMME', 2);
define('CATEGORY_KIDS', 3);
