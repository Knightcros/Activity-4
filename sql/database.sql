CREATE DATABASE IF NOT EXISTS student_db;
USE student_db;


CREATE TABLE IF NOT EXISTS teachers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    id_number VARCHAR(50) NOT NULL UNIQUE,
    course VARCHAR(100),
    subject VARCHAR(100),
    grade VARCHAR(10),
    department VARCHAR(100)
);


INSERT INTO teachers (name, email, password) 
VALUES ('Danikko Galang', 'teacher@school.edu', 'admin123');
