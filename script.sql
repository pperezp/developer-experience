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
    
    SET puntos_actual = (SELECT puntos FROM alumno WHERE nombre = nom);
    SET puntos_final = puntos_actual + pts;
    SET idAlumno = (SELECT id FROM alumno WHERE nombre = nom);
    
    UPDATE alumno SET puntos = puntos_final WHERE id = idAlumno;
    SELECT CONCAT('Puntos actual de ',CONCAT(nom, CONCAT(' :', puntos_final)));
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
	WHERE 
		puntos > 0
	ORDER BY LOG(2, puntos) DESC;
END $$
DELIMITER ; 
-- drop procedure getTablaNiveles;

CALL addPuntos('Jose Donoso', 1);
CALL getTablaNiveles();

SELECT log(10,2)



