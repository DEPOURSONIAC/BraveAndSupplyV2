PRAGMA foreign_keys = ON;

-- ==========================
-- USERS
-- ==========================

CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    role TEXT NOT NULL DEFAULT 'user'
        CHECK(role IN ('user', 'admin')),
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    address TEXT,
    updated_at TEXT DEFAULT CURRENT_TIMESTAMP
);

-- ==========================
-- CATEGORIES
-- ==========================

CREATE TABLE categories (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- ==========================
-- PRODUCTS
-- ==========================

CREATE TABLE products (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    category_id INTEGER,
    name TEXT NOT NULL,
    description TEXT,
    price REAL NOT NULL CHECK(price >= 0),
    stock INTEGER NOT NULL DEFAULT 0 CHECK(stock >= 0),
    image TEXT,
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (category_id)
        REFERENCES categories(id)
        ON DELETE SET NULL
);

-- ==========================
-- COUPONS
-- ==========================

CREATE TABLE coupons (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    code TEXT NOT NULL UNIQUE,
    reduce INTEGER NOT NULL
);

-- ==========================
-- CARTS
-- ==========================

CREATE TABLE carts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
);

-- ==========================
-- CART ITEMS
-- ==========================

CREATE TABLE cart_items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    cart_id INTEGER NOT NULL,
    product_id INTEGER NOT NULL,
    quantity INTEGER NOT NULL DEFAULT 1,

    FOREIGN KEY (cart_id)
        REFERENCES carts(id)
        ON DELETE CASCADE,

    FOREIGN KEY (product_id)
        REFERENCES products(id)
        ON DELETE CASCADE
);

-- ==========================
-- FAVORITES
-- ==========================

CREATE TABLE favorites (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    product_id INTEGER NOT NULL,

    FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE,

    FOREIGN KEY (product_id)
        REFERENCES products(id)
        ON DELETE CASCADE
);

-- ==========================
-- ORDERS
-- ==========================

CREATE TABLE orders (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    total_price REAL NOT NULL,

    status TEXT NOT NULL DEFAULT 'pending'
        CHECK(status IN ('pending','paid','shipped','delivered','cancelled')),

    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
);

-- ==========================
-- ORDER ITEMS
-- ==========================

CREATE TABLE order_items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    order_id INTEGER NOT NULL,
    product_id INTEGER NOT NULL,
    quantity INTEGER NOT NULL,
    price REAL NOT NULL,

    FOREIGN KEY (order_id)
        REFERENCES orders(id)
        ON DELETE CASCADE,

    FOREIGN KEY (product_id)
        REFERENCES products(id)
        ON DELETE CASCADE
);

-- ==========================
-- PRODUCT LISTS
-- ==========================

CREATE TABLE product_lists (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    name TEXT NOT NULL,

    FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
);

-- ==========================
-- PRODUCT LIST ITEMS
-- ==========================

CREATE TABLE product_list_items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    list_id INTEGER NOT NULL,
    product_id INTEGER NOT NULL,

    FOREIGN KEY (list_id)
        REFERENCES product_lists(id)
        ON DELETE CASCADE,

    FOREIGN KEY (product_id)
        REFERENCES products(id)
        ON DELETE CASCADE
);

-- ==========================
-- REVIEWS
-- ==========================

CREATE TABLE reviews (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    comment TEXT,
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
);


-- ----------
-- Ajout des datas par défaut
-- ----------

-- ===========================================
-- CATEGORIES
-- ===========================================

INSERT INTO categories (id, name, created_at) VALUES
(1, 'Homme', '2026-05-28 12:24:53'),
(2, 'Femme', '2026-05-28 12:24:53'),
(3, 'Enfant', '2026-05-28 12:24:53'),
(4, 'Accessoires', '2026-05-28 12:24:53');

-- ===========================================
-- PRODUCTS
-- ===========================================

INSERT INTO products (id, category_id, name, description, price, stock, image, created_at) VALUES
(1, 1, 'Costume bleu rayé croisé', 'Costume homme élégant bleu marine à rayures fines, coupe croisée moderne. Idéal pour événements professionnels et cérémonies.', 149.99, 12, 'costume-bleu-raye-croise.jpg', '2026-05-28 12:25:52'),

(2, 3, 'Costume enfant cérémonie beige', 'Costume beige pour enfant, parfait pour mariages et grandes occasions. Tissu confortable et coupe adaptée aux mouvements.', 59.99, 20, 'costume-enfant-ceremonie-beige-2.jpg', '2026-05-28 12:25:52'),

(3, 2, 'Crop top en coton piqué fleuri', 'Crop top femme en coton piqué avec motif floral. Léger, respirant, idéal pour l’été ou un look décontracté chic.', 24.99, 35, 'crop-top-en-coton-pique-fleuri.jpg', '2026-05-28 12:25:52');

-- ===========================================
-- USERS
-- ===========================================

INSERT INTO users (id, name, email, password, role, created_at, address, updated_at) VALUES
(1, 'Toto Grimal', 'toto.grimal@iut.fr', '$2y$10$TUIdC/3cUB1.dCGNE9c40.V4NAxoae/E8m5Qt3V57XsB2jAdg4lm.', 'admin', '2026-05-21 18:52:33', '1600 Pennsylvania Avenue NW, Washington, D.C., États-Unis', '2026-06-22 20:21:35'),

(2, 'Michel Polnareff', 'michel.polnareff@la-defense.com', '$2y$10$TUIdC/3cUB1.dCGNE9c40.V4NAxoae/E8m5Qt3V57XsB2jAdg4lm.', 'admin', '2026-05-21 18:52:33', 'Puteaux La Défense 92800 Paris', '2026-06-22 20:41:17'),

(3, 'Alice Liddell', 'alice.liddell@test.com', '$2y$10$TUIdC/3cUB1.dCGNE9c40.V4NAxoae/E8m5Qt3V57XsB2jAdg4lm.', 'admin', '2026-05-21 18:52:33', 'Piazza del Colosseo, 1, Rome, Italie', '2026-06-22 20:40:22'),

(4, 'Bob Marley', 'bob.marley@gmail.com', '$2y$10$TUIdC/3cUB1.dCGNE9c40.V4NAxoae/E8m5Qt3V57XsB2jAdg4lm.', 'admin', '2026-05-21 18:52:33', '221B Baker Street, Londres, Royaume-Uni', '2026-06-22 20:40:51'),

(5, 'Michael Olise', 'michael.olise@gmail.com', '$2y$10$TUIdC/3cUB1.dCGNE9c40.V4NAxoae/E8m5Qt3V57XsB2jAdg4lm.', 'user', '2026-05-21 18:52:33', '44 Rue Nationale, Lille', '2026-06-22 19:33:19'),

(6, 'Emmanuel Macron', 'emmanuel.macron@gmail.com', '$2y$10$TUIdC/3cUB1.dCGNE9c40.V4NAxoae/E8m5Qt3V57XsB2jAdg4lm.', 'user', '2026-05-21 18:52:33', '9 Rue des Lilas, Bordeaux', '2026-06-22 19:33:27'),

(7, 'Brad Pitt', 'brad.pittd@gmail.com', '$2y$10$TUIdC/3cUB1.dCGNE9c40.V4NAxoae/E8m5Qt3V57XsB2jAdg4lm.', 'user', '2026-05-21 18:52:33', '21 Avenue Jean Jaurès, Toulouse', '2026-06-22 19:33:35'),

(8, 'Marine Le Pen', 'marine.lepen@gmail.com', '$2y$10$TUIdC/3cUB1.dCGNE9c40.V4NAxoae/E8m5Qt3V57XsB2jAdg4lm.', 'user', '2026-05-21 18:52:33', '7 Rue de Strasbourg, Nantes', '2026-06-22 19:33:43'),

(9, 'Emma Watson', 'emma.watson@gmail.com', '$2y$10$TUIdC/3cUB1.dCGNE9c40.V4NAxoae/E8m5Qt3V57XsB2jAdg4lm.', 'user', '2026-05-21 18:52:33', '30 Rue Saint-Michel, Rennes', '2026-06-22 19:33:51'),

(10, 'Elon Musk', 'elon.musk@gmail.com', '$2y$10$TUIdC/3cUB1.dCGNE9c40.V4NAxoae/E8m5Qt3V57XsB2jAdg4lm.', 'user', '2026-05-21 18:52:33', '15 Rue du Commerce, Nice', '2026-06-22 19:34:03');

-- ===========================================
-- COUPONS
-- ===========================================

INSERT INTO coupons (id, code, reduce) VALUES
(1, 'WELCOME10', 10),
(2, 'SUMMER20', 20),
(3, 'VIP50', 50);


-- ===========================================
-- CARTS
-- ===========================================

INSERT INTO carts (id, user_id, created_at) VALUES
(1, 5, '2026-07-01 10:15:00'),
(2, 6, '2026-07-02 14:30:00'),
(3, 7, '2026-07-03 18:45:00');

-- ===========================================
-- CART ITEMS
-- ===========================================

INSERT INTO cart_items (id, cart_id, product_id, quantity) VALUES
(1, 1, 1, 1),
(2, 1, 3, 2),
(3, 2, 2, 1),
(4, 3, 1, 1),
(5, 3, 2, 1);

-- ===========================================
-- FAVORITES
-- ===========================================

INSERT INTO favorites (id, user_id, product_id) VALUES
(1, 5, 1),
(2, 5, 3),
(3, 6, 2),
(4, 7, 1),
(5, 8, 3),
(6, 9, 2);

-- ===========================================
-- PRODUCT LISTS
-- ===========================================

INSERT INTO product_lists (id, user_id, name) VALUES
(1, 5, 'Ma wishlist'),
(2, 6, 'Tenues été'),
(3, 7, 'Costumes préférés');

-- ===========================================
-- PRODUCT LIST ITEMS
-- ===========================================

INSERT INTO product_list_items (id, list_id, product_id) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 3),
(4, 3, 1),
(5, 3, 2);

-- ===========================================
-- ORDERS
-- ===========================================

INSERT INTO orders (id, user_id, total_price, status, created_at) VALUES
(1, 5, 149.99, 'paid', '2026-06-15 11:22:00'),
(2, 6, 84.98, 'shipped', '2026-06-18 16:40:00'),
(3, 7, 59.99, 'delivered', '2026-06-21 09:10:00'),
(4, 8, 174.98, 'pending', '2026-07-05 15:30:00'),
(5, 9, 24.99, 'cancelled', '2026-07-06 18:45:00');

-- ===========================================
-- ORDER ITEMS
-- ===========================================

INSERT INTO order_items (id, order_id, product_id, quantity, price) VALUES
(1, 1, 1, 1, 149.99),

(2, 2, 2, 1, 59.99),
(3, 2, 3, 1, 24.99),

(4, 3, 2, 1, 59.99),

(5, 4, 1, 1, 149.99),
(6, 4, 3, 1, 24.99),

(7, 5, 3, 1, 24.99);

-- ===========================================
-- REVIEWS
-- ===========================================

INSERT INTO reviews (id, user_id, comment, created_at) VALUES
(1, 5, 'Très bonne qualité, je recommande !', '2026-06-16 09:00:00'),
(2, 6, 'Livraison rapide et produit conforme.', '2026-06-19 18:30:00'),
(3, 7, 'Très satisfait de mon achat.', '2026-06-22 11:45:00'),
(4, 8, 'Le costume est magnifique.', '2026-07-03 14:20:00'),
(5, 9, 'Excellent rapport qualité/prix.', '2026-07-04 17:10:00'),
(6, 10, 'Je recommanderai sans hésiter.', '2026-07-05 20:05:00');