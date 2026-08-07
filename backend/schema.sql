-- Śliwa FH — MariaDB schema
-- Import this via phpMyAdmin on Hostinger (or `mysql -u ... -p dbname < schema.sql`).

CREATE TABLE IF NOT EXISTS admin_users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(64) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS products (
  id VARCHAR(20) PRIMARY KEY,           -- e.g. "p-101", kept from the old hardcoded IDs
  sku VARCHAR(40) NOT NULL,
  name VARCHAR(255) NOT NULL,
  category VARCHAR(40) NOT NULL,        -- ogrodnicze | metalowe | budowlane | reczne | bhp
  category_label VARCHAR(100) NOT NULL,
  brand VARCHAR(100),
  material VARCHAR(100),
  is_bestseller TINYINT(1) NOT NULL DEFAULT 0,
  is_new TINYINT(1) NOT NULL DEFAULT 0,
  is_promo TINYINT(1) NOT NULL DEFAULT 0,
  is_wholesale_discount TINYINT(1) NOT NULL DEFAULT 0,
  price_netto DECIMAL(10,2) NOT NULL,
  price_brutto DECIMAL(10,2) NOT NULL,
  wholesale_min_qty INT DEFAULT NULL,
  wholesale_price_netto DECIMAL(10,2) DEFAULT NULL,
  stock_qty INT NOT NULL DEFAULT 0,
  unit VARCHAR(40) NOT NULL DEFAULT 'szt.',
  image VARCHAR(255),
  description TEXT,
  specs JSON,                            -- key/value spec table, same shape as the old JS objects
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_name VARCHAR(255) NOT NULL,
  customer_phone VARCHAR(40) NOT NULL,
  status ENUM('pending','confirmed','picked_up','cancelled') NOT NULL DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  product_id VARCHAR(20) NOT NULL,
  product_name VARCHAR(255) NOT NULL,    -- snapshot, so it stays correct even if the product is later edited/deleted
  qty INT NOT NULL,
  price_brutto DECIMAL(10,2) NOT NULL,   -- price at time of order
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS quote_requests (
  id INT AUTO_INCREMENT PRIMARY KEY,
  company_name VARCHAR(255) NOT NULL,
  nip VARCHAR(20) NOT NULL,
  contact_email VARCHAR(255),
  contact_phone VARCHAR(40),
  message TEXT,
  status ENUM('new','responded','closed') NOT NULL DEFAULT 'new',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
