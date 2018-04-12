<?php
require_once("../model/Data.php");

$nombre = $_REQUEST["nombre"];
$d = new Data();

$d->crearAlumno($nombre);

header("location: ../crearAlumno.php");