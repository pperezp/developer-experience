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
            <input list="nombres" name="nombre" placeholder="Nombre:" require>
            <input type="number" name="puntos" placeholder="Puntos:" require>
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
                <th colspan="3">(-)</th>
                <th>Nombre</th>
                <th>Puntos</th>
                <th>Programador nivel</th>
                <th colspan="3">(+)</th>
            </tr>

            <?php 
            foreach($d->getTablaNiveles() as $dn){?>
                <tr>
                    <td>
                        <form action="controller/regPuntos.php" method="post">
                            <input type="hidden" name="nombre" value='<?php echo $dn->nombre;?>'>
                            <input type="hidden" name="puntos" value='-1'>
                            <input type="submit" value="-1">
                        </form>
                    </td>

                    <td>
                        <form action="controller/regPuntos.php" method="post">
                            <input type="hidden" name="nombre" value='<?php echo $dn->nombre;?>'>
                            <input type="hidden" name="puntos" value='-5'>
                            <input type="submit" value="-5">
                        </form>
                    </td>
                    
                    <td>
                        <form action="controller/regPuntos.php" method="post">
                            <input type="hidden" name="nombre" value='<?php echo $dn->nombre;?>'>
                            <input type="hidden" name="puntos" value='-10'>
                            <input type="submit" value="-10 ">
                        </form>
                    </td>
                    <td><?php echo $dn->nombre; ?></td>
                    <td><?php echo $dn->puntos; ?></td>
                    <td>
                        Nivel <?php echo ($dn->nivel == null?0:$dn->nivel); ?><progress value="<?php echo ($dn->progress == null?0:$dn->progress); ?>" max="1"></progress>
                    </td>
                    <td>
                        <form action="controller/regPuntos.php" method="post">
                            <input type="hidden" name="nombre" value='<?php echo $dn->nombre;?>'>
                            <input type="hidden" name="puntos" value='1'>
                            <input type="submit" value="+1">
                        </form>
                    </td>

                    <td>
                        <form action="controller/regPuntos.php" method="post">
                            <input type="hidden" name="nombre" value='<?php echo $dn->nombre;?>'>
                            <input type="hidden" name="puntos" value='5'>
                            <input type="submit" value="+5">
                        </form>
                    </td>
                    
                    <td>
                        <form action="controller/regPuntos.php" method="post">
                            <input type="hidden" name="nombre" value='<?php echo $dn->nombre;?>'>
                            <input type="hidden" name="puntos" value='10'>
                            <input type="submit" value="+10 ">
                        </form>
                    </td>

                    
                </tr>    
            <?php } ?>
        </table>

        

        
        <a href="crearAlumno.php">Crear alumno</a>
    </body>
</html>