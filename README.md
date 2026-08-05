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

~~~python
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
│       │
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
│       │   ├── reglement.php
│       │   └── privacy.php             
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
│       │   ├── contact.php
│       │   └── faq.php            
│       │
│       └── home.php
│
├── config/
│   ├── config.php
│   └── database.php
│
├── core/
│   ├── router.php
│   └── helpers.php
│
├── deployment/
│   └── apache2/
│       ├── braveandsupply.conf
│       └── .htaccess.example
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
│   ├── .htaccess      
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
