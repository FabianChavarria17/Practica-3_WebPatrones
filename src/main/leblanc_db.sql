CREATE DATABASE IF NOT EXISTS leblanc_db CHARACTER SET utf8 COLLATE utf8_general_ci;
 
USE leblanc_db;
 
CREATE TABLE IF NOT EXISTS users (
  id       INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  rol      VARCHAR(10)  NOT NULL DEFAULT 'user'
);
 
CREATE TABLE IF NOT EXISTS reservations (
  id               INT AUTO_INCREMENT PRIMARY KEY,
  user_id          INT          NOT NULL,
  name             VARCHAR(100) NOT NULL,
  contact          VARCHAR(150) NOT NULL,
  reservation_date DATE         NOT NULL,
  people           INT          NOT NULL,
  comments         TEXT,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
 
 