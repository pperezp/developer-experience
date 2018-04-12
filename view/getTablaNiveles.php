<?php
require_once("../model/Data.php");

$d = new Data();
?>

<table border="1">
    <tr>
        <th colspan="3">(-)</th>
        <th>Nombre</th>
        <th>Puntos</th>
        <th>Programador nivel</th>
        <th colspan="3">(+)</th>
    </tr>

    <?php 
    if(isset($_REQUEST["top"])){
        $lista = $d->getTop($_REQUEST["top"]);
    }else{
        $lista = $d->getTablaNiveles();
    }

    foreach($lista as $dn){?>
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