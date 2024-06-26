CREATE DATABASE project_botique;
USE project_botique;
CREATE TABLE data(
	id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL);
