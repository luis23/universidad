<?php
session_start();
require_once 'conexionpractica.class.php';

class Manejador {

    private $con;

    function __construct() {
        /* $this->Usuario=$_POST['usuario'];;
          $this->Clave = $_POST['pass']; */
        $this->con=$_SESSION['conexion'];
        $this->Usuario = "administrador";
        $this->Clave = "admin";
        $this->BaseDatos = "Universidad";
        if(empty($con)){
          $this->con = new DBConexion($this->Usuario, $this->Clave);
          $_SESSION['conexion']=$this->con;
        }
    }

    function crearAlumno($carnet, $nombre, $direccion, $correo, $sede) {
      $this->con->conectar();
      $this->carnet=$carnet;
      $this->nombre=$nombre;
      $this->direccion=$direccion;
      $this->correo=$correo;
      $this->sede=$sede;
      $this->query = "INSERT INTO Alumnos (carnet, nombre, direccion, correo, sede) VALUES ('".$this->carnet."', '".$this->nombre."', '".$this->direccion."', '".$this->correo."', ".$this->sede.");";

      $this->resultadoss = mysql_query($this->query);
      if ($this->resultadoss) {
          return true;
      } else {
          return mysql_error();
      }
    }

    function crearCatedratico($idcatedratico, $nombre, $correo, $telefono) {
      $this->con->conectar();
      $this->idcatedratico=$idcatedratico;
      $this->nombre=$nombre;
      $this->correo=$correo;
      $this->telefono=$telefono;
      $this->query = "INSERT INTO Catedraticos (idcatedratico, nombre, correo, telefono) VALUES ('".$this->idcatedratico."', '".$this->nombre."', '".$this->correo."', ".$this->telefono.");";

      $this->resultadoss = mysql_query($this->query);
      if ($this->resultadoss) {
          return true;
      } else {
          return mysql_error();
      }
    }

    function crearUsuario($usuario,$clave){
      $this->con->conectar();
      $this->usuario=$usuario;
      $this->clave=$clave;

      $this->query="INSERT INTO Usuario (login,password) VALUES('".$this->usuario."','".$this->clave."')";
      $this->resultado=mysql_query($this->query);
      if ($this->resultadoss) {
          return true;
      } else {
          return mysql_error();
      }
    }

    function verUniversidades() {
      $this->con->conectar();
      $this->query = "SELECT nombre FROM Universidad;";
      $this->resultado = mysql_query($this->query);
      return $this->resultado;
    }

    function verSedes() {
      $this->con->conectar();
      $this->query = "SELECT nombreExtencion FROM Campus_Ext;";
      $this->resultado = mysql_query($this->query);
      return $this->resultado;
    }

    function verCarreras(){
      $this->con->conectar();
      $this->query = "SELECT nombre_carrera FROM Carrera;";
      $this->resultado=mysql_query($this->query);
      return $this->resultado;
    }

    function verCursosPorCarrera($carrera){
      $this->carrera=$carrera;
      $this->con->conectar();
      $this->query2="SELECT idcarrera FROM Carrera WHERE nombre_carrera = '".$this->carrera."'";
      $this->id = mysql_query($this->query2);
      $this->row = mysql_fetch_array($this->id);
      $this->query = "SELECT a.cod_curso, b.curso, a.semestre FROM Pensum a, Cursos b WHERE idcarrera = ".$this->row['idcarrera']." and a.cod_curso = b.idcurso;";
      $this->resultado=mysql_query($this->query);
      return $this->resultado;
    }


    function verIdPorNombreSede($nombre){
      $this->con->conectar();
      $this->nombreU=$nombre;
      $this->query="SELECT idext,iduniversidad FROM Campus_Ext WHERE nombreExtencion = '".$this->nombreU."';";
      $this->nombredado= mysql_query($this->query);
      return $this->nombredado;
    }
      function verIdPorNombreUniversidad($nombre){
      $this->con->conectar();
      $this->nombreU=$nombre;
      $this->query="SELECT idunivrersidad FROM Universidad WHERE nombre = '".$this->nombreU."';";
      $this->nombredado= mysql_query($this->query);
      return $this->nombredado;
    }

}

?>