<?php
require_once("../model/Data.php");

$nombre = $_REQUEST["nombre"];
$puntos = $_REQUEST["puntos"];
$d = new Data();

$d->addPuntos($nombre, $puntos);

header("location: ../index.php");