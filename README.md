# BraveAndSupply

Plateforme e-commerce de costumes.  
Architecture MVC maison avec routing, PDO, protection XSS, SQLi et base prête pour PayPal.

---

## Objectif

Créer une base e-commerce propre, sécurisée et évolutive :

- vente de costumes
- gestion utilisateurs
- authentification
- paiement PayPal
- structure vendable et maintenable

---

## Stack technique

- PHP (MVC maison)
- SQLite (PDO)
- HTML / CSS / JS

---

## Structure complète du projet

~~~asm
BraveAndSupply/
│
├── app/
│   │
│   ├── controllers/
│   │   ├── AuthController.php
│   │   ├── HomeController.php
│   │   ├── LegalController.php
│   │   ├── ProductController.php
│   │   └── UserController.php
│   │
│   ├── models/
│   │   ├── AuthModel.php
│   │   ├── CartModel.php
│   │   ├── CategoryModel.php
│   │   ├── CouponModel.php
│   │   ├── FavoriteModel.php
│   │   ├── OrderModel.php
│   │   ├── ProductListModel.php
│   │   ├── ProductModel.php
│   │   ├── ReviewModel.php
│   │   └── UserModel.php
│   └── views/       
│       ├── user/ 
│       |   ├── account.php 
│       │   └── account/ 
│       │       ├── profile.php 
│       │       ├── orders.php 
│       │       ├── cart.php 
│       │       └── reviews.php
│       ├── auth/
│       │   ├── login.php
│       │   ├── account.php
│       │   ├── cart.php
│       │   ├── register.php            
│       │   ├── forgot-password.php     
│       │   └── reset-password.php      
│       │
│       ├── legal/
│       │   ├── cgv.php
│       │   ├── infos.php
│       │   ├── mentions.php
│       │   └── reglement.php          
│       │
│       ├── shop/
│       │   ├── catalogue.php
│       │   ├── category.php
│       │   ├── product.php
│       │   ├── search.php              
│       │   ├── favorites.php           
│       │   ├── checkout.php    
│       │   └── orders.php              
│       │
│       ├── annex/
│       │   ├── about.php
│       │   └── contact.php           
│       │
│       └── home.php
│
├── config/
|   ├── .htaccess
|   ├── braveandsupplyv2.db
|   ├── braveAndSupplyV2.sql
│   ├── config.php
│   └── database.php
│
├── core/
|   ├── .htaccess
│   ├── bootstrap.php
│   ├── router.php
│   └── helpers.php
│
├── deployment/
|   ├── .htaccess
|   ├── note/
|   |   └── enPLus.txt
│   └── apache2/
|       └── sites-available/
│           └── 000-default.conf
│
├── includes/
│   ├── header.php
│   ├── footer.php
│   ├── navbar.php
│   ├── sidebar.php
│   ├── flash.php
│   └── pagination.php
│
├── public/      
│   ├── index.php
│   │
│   └── assets/
│       ├── css/
│       │   ├── style.css
│       │   ├── auth.css
│       │   ├── shop.css
│       │   └── admin.css
│       │
│       ├── js/
│       │   └── ajax.js
│       │
│       └── images/
│           ├── logo.png
│           └── users/
│
├── routes/
│   └── web.php
│
├── storage/
│   └──logs/
│           ├── products/
│       └── app.log
│ 
└── README.md

~~~

## Conventions de nommage

Le projet suit des conventions de nommage uniformes afin de faciliter la lecture et la maintenance du code car sinon je me perds.

- **Variables et paramètres** : `snake_case`
  - Exemple : `$user_id`, `$product_id`
- **Fonctions** : `camelCase`
  - Exemple : `getCurrentUser()`, `addToCart()`
- **Fichiers PHP** : `PascalCase`
  - Exemple : `UserController.php`, `CartModel.php`
- **Constantes** : `UPPER_SNAKE_CASE`
  - Exemple : `BASE_URL`, `MODEL_PATH`
- **Tables SQL** : `camelCase`
  - Exemple : `cartItems`
- **Colonnes SQL** : `snake_case`
  - Exemple : `$user_id`
  
## Reste à faire:
  Favoris
  Liste de produits

  Avis
  
  Coupons

  Mini-onglets

  Checkout
  Paiement

  Sécurité
  Tests

  Refactoring / nettoyage
  README final