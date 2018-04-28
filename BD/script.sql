CREATE DATABASE experience;

USE experience;

CREATE TABLE alumno(
	id INT AUTO_INCREMENT,
    nombre VARCHAR(100),
    puntos int,
    PRIMARY KEY(id)
); -- SELECT * FROM alumno;

CREATE TABLE usuario(
	rut VARCHAR(12),
	nombre VARCHAR(100),
	PRIMARY KEY(rut)
); -- SELECT * FROM usuario;

INSERT INTO usuario VALUES(NULL, '16828943','Patricio Pérez Pinto');

