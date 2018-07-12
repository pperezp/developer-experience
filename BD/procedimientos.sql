USE experience;

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

    /*
    const MANTUVO_NIVEL  = 0;
    const SUBIO_NIVEL    = 1;
    const BAJO_NIVEL     = 2;
    const SUMA_NEGATIVO  = 3;
    const RESTA_NEGATIVO = 4;
    */

    -- SELECT nivel_actual, nivel_final;

    IF puntos_final < 0 THEN -- si puntaje final es negativo
        -- Si bajé abruptamente de niveles
        IF nivel_actual > 0 THEN -- si el nivel era mayor a 0
            SELECT 2 AS 'estado'; -- BAJO_NIVEL
        ELSEIF puntos_final > puntos_actual THEN
            SELECT 3 AS 'estado';           -- Le di puntos pero aún es negativo
        ELSE
            SELECT 4 AS 'estado';           -- le quite puntos pero sigue negativo
        END IF;
    ELSEIF nivel_actual IS NULL THEN        -- Esto ocurre cuando paso de un puntaje negativo a uno positivo
        IF nivel_final = 0 THEN
            SELECT 0 AS 'estado'; -- MANTUVO_NIVEL
        ELSE
            SELECT 1 AS 'estado'; -- SUBIO_NIVEL
        END IF;
    ELSEIF nivel_actual = nivel_final THEN
		SELECT 0 AS 'estado'; -- MANTUVO_NIVEL
	ELSEIF nivel_final > nivel_actual THEN
		SELECT 1 AS 'estado'; -- SUBIO_NIVEL
	ELSE
		SELECT 2 AS 'estado'; -- BAJO_NIVEL
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


/*
DELIMITER $$
CREATE FUNCTION isUsuario(rut_usu VARCHAR(12)) RETURNS BOOLEAN
BEGIN 
	DECLARE nombre VARCHAR(100);
    
    SET nombre = (SELECT nombre FROM usuario WHERE rut = rut_usu);
    
    IF nombre != '' THEN 
		RETURN TRUE;
	ELSE
		RETURN FALSE;
    END IF;
END $$
DELIMITER ; 

DROP FUNCTION isUsuario;*/


CALL addPuntos('Marcelo Aranda', 30);
CALL getTablaNiveles();
CALL getTop(113);
CALL addPuntos('test', 100);