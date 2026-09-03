<?php

/*
    Charge les fichiers de l'application.

    Ordre :
        1- Models
        2- Controllers
*/


// ---------------
// MODELS
// ---------------

require_once MODEL_PATH . '/AuthModel.php';
require_once MODEL_PATH . '/CartModel.php';
require_once MODEL_PATH . '/CategoryModel.php';
require_once MODEL_PATH . '/CouponModel.php';
require_once MODEL_PATH . '/FavoriteModel.php';
require_once MODEL_PATH . '/OrderModel.php';
require_once MODEL_PATH . '/ListModel.php';
require_once MODEL_PATH . '/ProductModel.php';
require_once MODEL_PATH . '/ReviewModel.php';
require_once MODEL_PATH . '/UserModel.php';


// ---------------
// CONTROLLERS
// ---------------

require_once CONTROLLER_PATH . '/AuthController.php';
require_once CONTROLLER_PATH . '/HomeController.php';
require_once CONTROLLER_PATH . '/LegalController.php';
require_once CONTROLLER_PATH . '/ProductController.php';
require_once CONTROLLER_PATH . '/UserController.php';
require_once CONTROLLER_PATH . '/CartController.php';
require_once CONTROLLER_PATH . '/OrderController.php';
require_once CONTROLLER_PATH . '/FavoriteController.php';
require_once CONTROLLER_PATH . '/ListController.php';
require_once CONTROLLER_PATH . '/ReviewController.php';
