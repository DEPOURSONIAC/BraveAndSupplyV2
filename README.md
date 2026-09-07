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
│   │   ├── CartController.php
│   │   ├── FavoriteController.php
│   │   ├── ReviewController.php
│   │   ├── CouponController.php
│   │   ├── OrderController.php
│   │   ├── CheckoutController.php
│   │   └── UserController.php
│   │
│   ├── models/
│   │   ├── AuthModel.php
│   │   ├── UserModel.php
│   │   ├── ProductModel.php
│   │   ├── ProductListModel.php
│   │   ├── CategoryModel.php
│   │   ├── CartModel.php
│   │   ├── FavoriteModel.php
│   │   ├── ReviewModel.php
│   │   ├── CouponModel.php
│   │   └── OrderModel.php
│   │
│   └── views/
│       │
│       ├── layouts/
│       │   ├── header.php
│       │   └── footer.php
│       │
│       ├── components/
│       │   ├── navbar.php
│       │   ├── user-menu.php
│       │   ├── flash.php
│       │   ├── pagination.php
│       │   └── product-card.php
│       │
│       ├── pages/
│       │   ├── home.php
│       │
│       │   ├── auth/
│       │   │   ├── login.php
│       │   │   ├── register.php
│       │   │   ├── forgot-password.php
│       │   │   └── reset-password.php
│       │   │
│       │   ├── shop/
│       │   │   ├── catalogue.php
│       │   │   ├── category.php
│       │   │   ├── product.php
│       │   │   ├── search.php
│       │   │   └── favorites.php
│       │   │
│       │   ├── cart/
│       │   │   ├── cart.php
│       │   │   └── checkout.php
│       │   │
│       │   ├── orders/
│       │   │   ├── orders.php
│       │   │   └── order.php
│       │   │
│       │   ├── user/
│       │   │   ├── account.php
│       │   │   ├── profile.php
│       │   │   └── reviews.php
│       │   │
│       │   ├── legal/
│       │   │   ├── cgv.php
│       │   │   ├── infos.php
│       │   │   ├── mentions.php
│       │   │   └── reglement.php
│       │   │
│       │   └── annex/
│       │       ├── about.php
│       │       └── contact.php
│       │
│       └── errors/
│           ├── 403.php
│           ├── 404.php
│           └── 500.php
│
├── config/
│   ├── .htaccess
│   ├── config.php
│   ├── database.php
│   ├── braveandsupplyv2.db
│   └── braveAndSupplyV2.sql
│
├── core/
│   ├── .htaccess
│   ├── bootstrap.php
│   ├── router.php
│   └── helpers.php
│
├── public/
│   ├── index.php
│   │
│   └── assets/
│       ├── css/
│       │   ├── style.css
│       │   ├── auth.css
│       │   ├── shop.css
│       │   ├── cart.css
│       │   ├── account.css
│       │   ├── checkout.css
│       │   └── admin.css
│       │
│       ├── js/
│       │   ├── main.js
│       │   ├── ajax.js
│       │   ├── cart.js
│       │   └── checkout.js
│       │
│       └── images/
│           ├── logo.png
│           ├── products/
│           └── supplement/
│
├── routes/
│   └── web.php
│
├── storage/
│   ├── logs/
│   │   └── app.log
│
├── deployment/
│   ├── .htaccess
│   └── apache2/
│       └── sites-available/
│           └── 000-default.conf
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