CREATE DATABASE contact_db;

USE contact_db;

CREATE TABLE contacts (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL
);
