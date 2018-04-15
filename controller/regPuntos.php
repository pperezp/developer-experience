<?php
require_once("../model/Data.php");

$nombre = $_REQUEST["nombre"];
$puntos = $_REQUEST["puntos"];
$d = new Data();

$estado = $d->addPuntos($nombre, $puntos);

echo $estado->estado."/$puntos";

/*header("location: ../index.php");*/