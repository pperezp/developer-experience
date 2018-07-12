<?php
require_once("../model/Data.php");

$d = new Data();
?>

<table class="table table-striped">
    <tr>
        <!--<th colspan="3">(-)</th> -->
        <th style="width: 5%">Pos.</th>
        <th style="width: 20%">Nombre</th>
        <!-- <th>Puntos</th> -->
        <th style="width: 10%">Nivel</th>
        <th style="width: 35%">Progreso</th>
        <!--<th colspan="3">(+)</th>-->
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
        <tr 
        <?php 
        if($pos >= 1 && $pos <= 3){
            echo "class='bg-success text-white'";
        }
        ?>>
            
            <td><?php echo $pos.".-"; ?></td>
            
            <td><?php echo $dn->nombre; ?></td>
            <!-- <td><?php echo $dn->puntos; ?></td>-->
            <td>
                Nvl. <?php echo ($dn->nivel == null?0:$dn->nivel); ?>
            </td>

            <td>
                <div class="progress">
                    <?php
                    $progreso = ($dn->progress == null ? 0 : ($dn->progress * 100));
                    ?>
                    <div 
                        class="progress-bar bg-info" 
                        role="progressbar" 
                        style="width: <?php echo $progreso; ?>%;" 
                        aria-valuenow="<?php echo $progreso; ?>" 
                        aria-valuemin="0" 
                        aria-valuemax="100">
                            <?php echo $progreso; ?>%
                    </div>
                    
                </div>
                <?php echo $dn->puntos; ?> puntos
                <!-- <progress class="progress progress-bar" role="progressbar" value="<?php echo ($dn->progress == null?0:$dn->progress); ?>" max="1"></progress>-->
            </td>
        </tr>   
        <?php $pos++;?>
    <?php } ?>
</table>