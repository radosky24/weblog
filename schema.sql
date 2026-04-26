-- schema.sql
CREATE DATABASE IF NOT EXISTS weblog;
USE weblog;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100),
    role ENUM('admin', 'editor') DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    summary TEXT,
    content LONGTEXT,
    image_url VARCHAR(255),
    author_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Insert a default admin user (password: 1234)
-- Using password_hash('1234', PASSWORD_DEFAULT)
INSERT INTO users (username, password, full_name, role) 
VALUES ('admin', '$2y$10$PQUV5.AGwsXtgt2.zVwZ/OClkZ7mVD3Q/8zqDxuDIEO7GICC4KTCu', 'Administrator', 'admin')
ON DUPLICATE KEY UPDATE username=username;
