<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Experience</title>
    </head>
    <body>
        <form action="controller/regPuntos.php" method="post">
            <input list="nombres" name="nombre" placeholder="Nombre:">
            <input type="number" name="puntos" placeholder="Puntos:">
            <input type="submit" value="Asignar Puntos">

            <datalist id="nombres">
            <?php
                require_once("model/Data.php");

                $d = new Data();

                foreach($d->getAlumnos() as $a){
                    echo "<option value='".$a->getNombre()."'>";
                }
            ?>
            </datalist>
        </form>

        <table border="1">
            <tr>
                <th>Nombre</th>
                <th>Puntos</th>
                <th>Programador nivel</th>
            </tr>

            <?php 
            foreach($d->getTablaNiveles() as $dn){?>
                <tr>
                    <td><?php echo $dn->nombre; ?></td>
                    <td><?php echo $dn->puntos; ?></td>
                    <td>
                        Nivel <?php echo $dn->nivel; ?><progress value="<?php echo $dn->progress; ?>" max="1"></progress>
                    </td>
                </tr>    
            <?php } ?>
        </table>

        

        
        <a href="crearAlumno.php">Crear alumno</a>
    </body>
</html>