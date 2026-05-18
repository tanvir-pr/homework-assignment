CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    family_name VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    login_name VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_name VARCHAR(150) NOT NULL,
    sender_email VARCHAR(150) NOT NULL,
    subject VARCHAR(200) NOT NULL,
    message_body TEXT NOT NULL,
    user_id INT NULL,
    created_at DATETIME NOT NULL,
    CONSTRAINT fk_messages_users FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS gallery_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    file_name VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    created_at DATETIME NOT NULL,
    CONSTRAINT fk_gallery_users FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS pizza_categories (
    cname VARCHAR(50) PRIMARY KEY,
    price INT NOT NULL
);

CREATE TABLE IF NOT EXISTS pizzas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pizza_name VARCHAR(150) NOT NULL UNIQUE,
    category_name VARCHAR(50) NOT NULL,
    vegetarian TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL,
    CONSTRAINT fk_pizzas_categories FOREIGN KEY (category_name) REFERENCES pizza_categories(cname)
);

CREATE TABLE IF NOT EXISTS pizza_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pizza_name VARCHAR(150) NOT NULL,
    amount INT NOT NULL,
    taken DATETIME NOT NULL,
    dispatched DATETIME NOT NULL
);

-- ------------------------------------------------------------
-- Sample seed data for quick testing
-- Login test user: login_name = demo_user, password = Password123!
-- ------------------------------------------------------------

INSERT INTO users (family_name, surname, login_name, password_hash)
VALUES
    ('Demo', 'User', 'demo_user', '$2b$12$q6PPFEH0GUB50e3Tn9ZGUexyVsryteE/1hTQeNc4Ulh8C5.C8Gs/m')
ON DUPLICATE KEY UPDATE login_name = VALUES(login_name);

INSERT INTO pizza_categories (cname, price)
VALUES
    ('page', 850),
    ('nobleman', 950),
    ('knight', 1150),
    ('king', 1250)
ON DUPLICATE KEY UPDATE price = VALUES(price);

INSERT INTO pizzas (pizza_name, category_name, vegetarian, created_at)
VALUES
    ('Popey', 'king', 0, NOW()),
    ('Kagylos', 'king', 0, NOW()),
    ('Csupa sajt', 'knight', 1, NOW()),
    ('Sajtos', 'page', 1, NOW()),
    ('Hawaii', 'nobleman', 0, NOW()),
    ('Vega', 'knight', 1, NOW()),
    ('Son-go-ku', 'nobleman', 1, NOW()),
    ('Barbecue chicken', 'knight', 0, NOW())
ON DUPLICATE KEY UPDATE category_name = VALUES(category_name), vegetarian = VALUES(vegetarian);

INSERT INTO pizza_orders (pizza_name, amount, taken, dispatched)
VALUES
    ('Popey', 2, '2005-11-12 11:21:00', '2005-11-12 12:11:00'),
    ('Kagylos', 1, '2005-11-12 11:41:00', '2005-11-12 12:26:00'),
    ('Barbecue chicken', 1, '2005-11-12 12:38:00', '2005-11-12 13:02:00'),
    ('Hawaii', 1, '2005-11-14 06:51:00', '2005-11-14 08:37:00'),
    ('Sajtos', 1, '2005-11-13 01:31:00', '2005-11-13 04:24:00');

INSERT INTO messages (sender_name, sender_email, subject, message_body, user_id, created_at)
VALUES
    ('Guest Visitor', 'guest@example.com', 'Question', 'Can I order vegetarian pizza from this menu?', NULL, NOW()),
    ('Demo User', 'demo@example.com', 'Suggestion', 'Please add more pizza photos to the gallery.', (SELECT id FROM users WHERE login_name = 'demo_user' LIMIT 1), NOW());
