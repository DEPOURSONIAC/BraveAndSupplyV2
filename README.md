# BraveAndSupply V2

Plateforme e-commerce de costumes (version améliorée et sécurisée).  
Architecture MVC maison avec routing, PDO, protection XSS et base prête pour PayPal.

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
- MySQL (PDO)
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
│       │   ├── app.js
│       │   ├── cart.js
│       │   ├── search.js
│       │   └── validation.js
│       │
│       └── images/
│           ├── logo.png
│           ├── products/
│           └── users/
│
├── routes/
│   └── web.php
│
├── storage/
│   └──logs/
│       └── app.log
│ 
└── README.md

~~~
