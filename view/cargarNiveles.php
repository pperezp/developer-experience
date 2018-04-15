<?php
require_once("../model/Data.php");

$d = new Data();
?>

<table border="0">
    <tr>
        <th colspan="3">(-)</th>
        <th>Pos.</th>
        <th>Nombre</th>
        <th>Puntos</th>
        <th>Nivel</th>
        <th>Progreso</th>
        <th colspan="3">(+)</th>
    </tr>

    <?php 
    if(isset($_REQUEST["top"])){
        $lista = $d->getTop($_REQUEST["top"]);
    }else{
        $lista = $d->getTablaNiveles();
    }

    $pos = 1;
    foreach($lista as $dn){
        $nom = $dn->nombre;
        ?>
        <tr>
            <td>
            <!-- La función regPuntos está actualmente en index.php-->
                <input type="button" value="-1" onclick="regPuntos('<?php echo $nom ;?>', -1)">
            </td>

            <td>
                <input type="button" value="-5" onclick="regPuntos('<?php echo $nom ;?>', -5)">
            </td>
            
            <td>
                <input type="button" value="-10" onclick="regPuntos('<?php echo $nom ;?>', -10)">
            </td>
            <td><?php echo $pos.".-"; ?></td>
            <?php $pos++;?>
            <td><?php echo $dn->nombre; ?></td>
            <td><?php echo $dn->puntos; ?></td>
            <td>
                Nivel <?php echo ($dn->nivel == null?0:$dn->nivel); ?>
            </td>

            <td>
                <progress value="<?php echo ($dn->progress == null?0:$dn->progress); ?>" max="1"></progress>
            </td>

            <td>
                <input type="button" value="+1" onclick="regPuntos('<?php echo $nom ;?>', 1)">
            </td>

            <td>
                <input type="button" value="+5" onclick="regPuntos('<?php echo $nom ;?>', 5)">
            </td>
            
            <td>
                <input type="button" value="+10" onclick="regPuntos('<?php echo $nom ;?>', 10)">
            </td>
        </tr>    
    <?php } ?>
</table>