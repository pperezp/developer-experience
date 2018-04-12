<?php
require_once("Conexion.php");
require_once("Alumno.php");

class Data{
    private $c;

    public function __construct(){
        $this->c = new Conexion("experience");
    }

    public function getAlumnos(){
        $this->c->conectar();

        $alumnos = array();

        $rs = $this->c->ejecutar("SELECT * FROM alumno");

        while($obj = $rs->fetch_array()){
            $id = $obj[0];
            $nombre = $obj[1];
            $puntos = $obj[2];

            $a = new Alumno();
            
            $a->setId($id);
            $a->setNombre($nombre);
            $a->setPuntos($puntos);

            array_push($alumnos, $a);
        }

        $this->c->desconectar();

        return $alumnos;
    }

    public function getAlumnosBy($filtro){
        $this->c->conectar();

        $alumnos = array();

        $rs = $this->c->ejecutar("SELECT * FROM alumno WHERE nombre LIKE '%$filtro%'");

        while($obj = $rs->fetch_array()){
            $id = $obj[0];
            $nombre = $obj[1];
            $puntos = $obj[2];

            $a = new Alumno();
            
            $a->setId($id);
            $a->setNombre($nombre);
            $a->setPuntos($puntos);

            array_push($alumnos, $a);
        }

        $this->c->desconectar();

        return $alumnos;
    }

    public function crearAlumno($nombre){
        $this->c->conectar();
        $this->c->ejecutar("INSERT INTO alumno VALUES(NULL, '$nombre','0')");
        $this->c->desconectar();
    }

    public function addPuntos($nombre, $puntos){
        $this->c->conectar();
        $this->c->ejecutar("CALL addPuntos('$nombre', $puntos);");
        $this->c->desconectar();
    }
    
    public function getTablaNiveles(){
        $lista = array();
        $this->c->conectar();
        $rs = $this->c->ejecutar("CALL getTablaNiveles();");

        while($obj = $rs->fetch_object()){
            array_push($lista, $obj);
        }

        $this->c->desconectar();

        return $lista;  
    }

}
?>
