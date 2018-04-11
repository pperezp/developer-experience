<?php 
class Alumno{
    private $id;
    private $nombre;
    private $puntos;

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getPuntos(){
        return $this->puntos;
    }

    public function setId($id){
        $this->id = $id;
    }
    
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setPuntos($puntos){
        $this->puntos = $puntos;
    }
}
?>