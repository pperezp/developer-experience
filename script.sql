CREATE DATABASE experience;

USE experience;

CREATE TABLE alumno(
    id INT AUTO_INCREMENT,
    nombre VARCHAR(100),
    puntos int,
    PRIMARY KEY(id)
); -- SELECT * FROM alumno;


DELIMITER $$
CREATE PROCEDURE addPuntos(nom VARCHAR(100), pts INT)
BEGIN
	DECLARE puntos_actual INT;
    DECLARE puntos_final INT;
    DECLARE idAlumno INT;
    DECLARE nivel_actual INT;
    DECLARE nivel_final INT;
    DECLARE dificultad INT;
    
    SET dificultad = 3;
    SET nivel_actual = (SELECT FLOOR(LOG(dificultad, puntos)) FROM alumno WHERE nombre = nom);
    SET puntos_actual = (SELECT puntos FROM alumno WHERE nombre = nom);
    SET puntos_final = puntos_actual + pts;
    SET idAlumno = (SELECT id FROM alumno WHERE nombre = nom);
    
    UPDATE alumno SET puntos = puntos_final WHERE id = idAlumno;
    
    SET nivel_final = (SELECT FLOOR(LOG(dificultad, puntos)) FROM alumno WHERE nombre = nom);
    
    /*El nivel queda como null cuando es log(0) en base 3 --> dificultad*/
    IF nivel_actual = nivel_final OR nivel_actual IS NULL THEN
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
	DECLARE dificultad INT;
    SET dificultad = 3; -- base del logaritmo
	SELECT 
		nombre, 
		puntos, 
		FLOOR(LOG(dificultad, puntos)) AS 'nivel',
        ROUND(LOG(dificultad, puntos),2) - FLOOR(ROUND(LOG(dificultad, puntos),2)) AS 'progress' -- Progreso en porcentaje para pintar en HTML
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
	DECLARE dificultad INT;
    SET dificultad = 3; -- base del logaritmo
	SELECT 
		nombre, 
		puntos, 
		FLOOR(LOG(dificultad, puntos)) AS 'nivel',
        ROUND(LOG(dificultad, puntos),2) - FLOOR(ROUND(LOG(dificultad, puntos),2)) AS 'progress' -- Progreso en porcentaje para pintar en HTML
	FROM 
		alumno 
	/*WHERE 
		puntos >= 0*/
	ORDER BY puntos DESC
    LIMIT top;
END $$
DELIMITER ; 
-- drop procedure getTop;

CALL addPuntos('Marcelo Aranda', 1);
SELECT * FROM alumno;

CALL getTablaNiveles();
CALL getTop(3);

SELECT log(10,2)




