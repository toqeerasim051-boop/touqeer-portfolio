-- ═══════════════════════════════════════════════════════════
--  Portfolio Database Schema — InfinityFree Edition
--  IMPORT: phpMyAdmin → SQL tab
--  Note: InfinityFree creates the DB for you — skip CREATE DATABASE.
-- ═══════════════════════════════════════════════════════════

-- ── Contact Messages ─────────────────────────────────────────
CREATE TABLE IF NOT EXISTS contact_messages (
  id          INT UNSIGNED  NOT NULL AUTO_INCREMENT,
  name        VARCHAR(100)  NOT NULL,
  email       VARCHAR(254)  NOT NULL,
  subject     VARCHAR(200)  NOT NULL,
  message     TEXT          NOT NULL,
  ip_address  VARCHAR(45)   NOT NULL DEFAULT '',
  is_read     TINYINT(1)    NOT NULL DEFAULT 0,
  created_at  DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  INDEX idx_email      (email),
  INDEX idx_created_at (created_at),
  INDEX idx_is_read    (is_read)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Admin Users ──────────────────────────────────────────────
-- Default: username=admin  password=admin123  (CHANGE IMMEDIATELY)
CREATE TABLE IF NOT EXISTS admin_users (
  id            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  username      VARCHAR(60)  NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO admin_users (username, password_hash)
VALUES ('admin','$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- ── Projects ─────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS projects (
  id            INT UNSIGNED  NOT NULL AUTO_INCREMENT,
  title         VARCHAR(150)  NOT NULL,
  project_type  VARCHAR(60)   NOT NULL DEFAULT 'Web App',
  description   TEXT          NOT NULL,
  tech_stack    VARCHAR(400)  NOT NULL DEFAULT '',
  icon_class    VARCHAR(60)   NOT NULL DEFAULT 'bi-code-square',
  image_path    VARCHAR(500)           DEFAULT NULL,
  live_url      VARCHAR(500)           DEFAULT NULL,
  github_url    VARCHAR(500)           DEFAULT NULL,
  display_order TINYINT UNSIGNED NOT NULL DEFAULT 0,
  is_published  TINYINT(1)    NOT NULL DEFAULT 1,
  created_at    DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  INDEX idx_published (is_published),
  INDEX idx_order     (display_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO projects (title, project_type, description, tech_stack, icon_class, display_order) VALUES
('Student Management System','Full Stack','Full-stack CRUD app for managing student records, grades, and enrollment with role-based access.','PHP,MySQL,Bootstrap,JavaScript','bi-mortarboard-fill',1),
('E-Commerce Storefront','E-Commerce','Responsive online store with product listings, shopping cart, and order tracking backed by MySQL.','PHP,MySQL,Tailwind CSS,JavaScript','bi-cart-fill',2),
('Personal Blog CMS','CMS','Lightweight CMS with PHP admin panel for writing, editing, publishing and categorising blog posts.','PHP,MySQL,Bootstrap,CSS3','bi-journal-richtext',3),
('Task & Project Tracker','Productivity','Collaborative task board with user auth, task assignment, deadlines, and status pipelines in MySQL.','PHP,MySQL,JavaScript,Bootstrap','bi-kanban-fill',4);
