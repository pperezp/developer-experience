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

DELIMITER $$
CREATE PROCEDURE addPuntos(nom VARCHAR(100), pts INT)
BEGIN
	DECLARE puntos_actual INT;
    DECLARE puntos_final INT;
    DECLARE idAlumno INT;
    DECLARE nivel_actual INT;
    DECLARE nivel_final INT;
	DECLARE dificultad FLOAT;

	SET dificultad = 0.3;
    SET nivel_actual = (SELECT FLOOR(SQRT(puntos)*dificultad) FROM alumno WHERE nombre = nom);
    SET puntos_actual = (SELECT puntos FROM alumno WHERE nombre = nom);
    SET puntos_final = puntos_actual + pts;
    SET idAlumno = (SELECT id FROM alumno WHERE nombre = nom);
    
    UPDATE alumno SET puntos = puntos_final WHERE id = idAlumno;
    
    SET nivel_final = (SELECT FLOOR(SQRT(puntos)*dificultad) FROM alumno WHERE nombre = nom);
    
    /*El nivel queda como null cuando es log(0) en base 3 --> dificultad*/
    
    IF nivel_actual IS NULL THEN
		SET nivel_actual = 0;
	END IF;
    
    IF nivel_actual = nivel_final THEN
		SELECT 0 AS 'estado';
	ELSEIF nivel_final > nivel_actual THEN
		SELECT 1 AS 'estado';
	ELSE
		SELECT 2 AS 'estado';
	END IF;
	
    /*SELECT CONCAT('Puntos actual de ',CONCAT(nom, CONCAT(' :', puntos_final)));*/
END $$
DELIMITER ;
 -- drop procedure addPuntos;

DELIMITER $$
CREATE PROCEDURE getTablaNiveles()
BEGIN
	DECLARE dificultad FLOAT;

	SET dificultad = 0.3;

	SELECT
		nombre, 
		puntos, 
		FLOOR(SQRT(puntos)*dificultad) AS 'nivel',
        ROUND(SQRT(puntos)*dificultad ,2) - FLOOR(ROUND(SQRT(puntos)*dificultad,2)) AS 'progress' -- Progreso en porcentaje para pintar en HTML
	FROM 
		alumno 
	/*WHERE 
		puntos >= 0*/
	ORDER BY puntos DESC;
END $$
DELIMITER ; 
-- drop procedure getTablaNiveles;


DELIMITER $$
CREATE PROCEDURE getTop(top INT)
BEGIN
	DECLARE dificultad FLOAT;

	SET dificultad = 0.3;

	SELECT 
		nombre, 
		puntos, 
		FLOOR(SQRT(puntos)*dificultad) AS 'nivel',
        ROUND(SQRT(puntos)*dificultad,2) - FLOOR(ROUND(SQRT(puntos)*dificultad ,2)) AS 'progress' -- Progreso en porcentaje para pintar en HTML
	FROM 
		alumno 
	/*WHERE 
		puntos >= 0*/
	ORDER BY puntos DESC
    LIMIT top;
END $$
DELIMITER ; 
-- drop procedure getTop;

CALL addPuntos('Marcelo Aranda', 30);
SELECT * FROM alumno;

CALL getTablaNiveles();
CALL getTop(3);

SELECT log(10,2)




