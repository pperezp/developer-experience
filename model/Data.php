<?php
require_once("Conexion.php");
require_once("Alumno.php");

class Data{
    private $c;

    public function __construct(){
        $this->c = new Conexion("experience");
    }

    public function getUsuario($rut){
        $this->c->conectar();


        // EL objeto mysql de la clase Conexión, lo dejé público
        // ----------------------------- PREAPARE STATEMENT -------------------------------
        $sentencia = $this->c->mysql->prepare("SELECT * FROM usuario WHERE rut = ?");
        // i para enteros y s para cadenas
        $sentencia->bind_param("s", $rut);

        $sentencia->execute();
        $rs = $sentencia->get_result();
        $sentencia->close();
        // ----------------------------- PREAPARE STATEMENT --------------------------------



        $usuario = null;

        if($obj = $rs->fetch_object()){
            $usuario = $obj;
        }

        $this->c->desconectar();
        
        return $usuario;
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


        // EL objeto mysql de la clase Conexión, lo dejé público
        // ----------------------------- PREAPARE STATEMENT -------------------------------
        $sentencia = $this->c->mysql->prepare("SELECT * FROM alumno WHERE nombre LIKE ?");
        // i para enteros y s para cadenas
        $sentencia->bind_param("s", "'%$filtro%'");

        $sentencia->execute();
        $rs = $sentencia->get_result();
        $sentencia->close();
        // ----------------------------- PREAPARE STATEMENT --------------------------------



        //$rs = $this->c->ejecutar("SELECT * FROM alumno WHERE nombre LIKE '%$filtro%'");

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
        $rs = $this->c->ejecutar("CALL addPuntos('$nombre', $puntos);");

        $estado = null;

        if($obj = $rs->fetch_object()){
            $estado = $obj;
        }

        $this->c->desconectar();
        
        return $estado;
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

    public function getTop($limite){
        $lista = array();
        $this->c->conectar();
        $rs = $this->c->ejecutar("CALL getTop($limite);");

        while($obj = $rs->fetch_object()){
            array_push($lista, $obj);
        }

        $this->c->desconectar();

        return $lista;  
    }

}
?>
