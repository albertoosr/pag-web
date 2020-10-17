CREATE DATABASE paginacion CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';
USE paginacion;

CREATE TABLE productos(id INT AUTO_INCREMENT PRIMARY KEY,
		producto VARCHAR(60) NOT NULL)
		Engine = InnoDB CHARACTER SET 'UTF8' COLLATE 'utf8_general_ci';  