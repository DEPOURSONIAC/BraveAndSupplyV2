# BraveAndSupply V2

Plateforme e-commerce de costumes (version améliorée et sécurisée).  
Architecture MVC maison avec routing custom, PDO, protection XSS et base prête pour PayPal.

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
- PayPal API
- Router maison

---

## Structure complète du projet
```
BraveAndSupply/
│
├── public/
│   ├── index.php
│   └── assets/
│       ├── css/
│       ├── js/
│       └── img/
│
├── routes/
│   └── web.php
│
├── app/
│   ├── controllers/
│   │   ├── home.php
│   │   ├── auth.php
│   │   └── user.php
│   │
│   ├── models/
│   │   └── userModel.php
│   │
│   └── views/
│       ├── home/
│       │   └── index.php
│       ├── auth/
│       │   └── login.php
│       └── user/
│           └── profile.php
│
├── core/
│   └── router.php
│
├── config/
│   ├── config.php
│   └── database.php
│
├── includes/
│   └── helpers.php
│
├── storage/
│   └── logs/
│
└── README.md
```
