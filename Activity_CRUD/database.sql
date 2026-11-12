CREATE DATABASE IF NOT EXISTS studenthahaha_db2;
USE studenthahaha_db2;

CREATE TABLE IF NOT EXISTS course (
    course_ID INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255) NOT NULL,
    course_code VARCHAR(50) NOT NULL UNIQUE,
    status ENUM('on', 'off') DEFAULT 'on',
    date_created DATE DEFAULT (CURRENT_DATE)
);

CREATE TABLE IF NOT EXISTS user (
    user_ID INT AUTO_INCREMENT PRIMARY KEY,
    Firstname VARCHAR(50) NOT NULL,
    Lastname VARCHAR(50) NOT NULL,
    Middlename VARCHAR(50),
    Birthdate DATE NOT NULL,
    Gender ENUM('M', 'F') NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    date_created DATE DEFAULT (CURRENT_DATE)
);

CREATE TABLE IF NOT EXISTS user_course (
    user_ID INT NOT NULL,
    course_ID INT NOT NULL,
    PRIMARY KEY (user_ID, course_ID),
    FOREIGN KEY (user_ID) REFERENCES user(user_ID) ON DELETE CASCADE,
    FOREIGN KEY (course_ID) REFERENCES course(course_ID) ON DELETE CASCADE
);

INSERT IGNORE INTO course (name, description, course_code, status) VALUES 
('BS Information Technology', 'Information Technology', 'BSIT', 'on'),
('BS Mathematics', 'Mathematics', 'BSMATH', 'on'),
('BS Computer Science', 'Computer Science', 'BSCS', 'on');