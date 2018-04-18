<?php

require_once("../model/Data.php");

$d = new Data();
$user = $d->getUsuario($_REQUEST["rut"]);

if($user != null){
    session_start();

    $_SESSION["user"] = $user;

    header("location: ../view/experience.php");
}else{
    header("location: ../view/index.php?m=1");
}

