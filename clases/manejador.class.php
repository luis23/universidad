<?php
session_start();
require_once 'conexionpractica.class.php';

class Manejador {

    private $con;
    private $con2;

    function __construct() {

      if(empty($_SESSION['conexion'])){
        $this->Usuario = "administrador";
        $this->Clave = "admin";
        $this->BaseDatos = "Universidad";
        $this->con2 = new DBConexion($this->Usuario, $this->Clave);
      }else{
        $this->con= $_SESSION['conexion'];
      }
    }


    function loginUsuario($usuario,$pass){
      $this->usuario=$usuario;
      $this->password=$pass;

      $this->con2->conectar();
      $this->query="SELECT * FROM Usuario WHERE login='".$this->usuario."' and password='".$this->pass"';" ;
      $this->resultadoss = mysql_query($this->query);
      $this->query2="SELECT * FROM Asignacion_Permisos WHERE login='".$this->usuario."';";
      $this->resultados2 = mysql_query($this->query);
      $this->row = mysql_fetch_array($this->resultados2);
      if($this->row['rol']===1 || $this->row['rol']==="1"){
        $this->Usuario = "administrador";
        $this->Clave = "admin";
        $this->BaseDatos = "Universidad";
        $this->con = new DBConexion($this->Usuario, $this->Clave);
        $_SESSION['conexion']=$this->con;
        return 1;
      }else if($this->row['rol']===2 || $this->row['rol']==="2"){
        $this->Usuario = "Profesor";
        $this->Clave = "catedratico";
        $this->BaseDatos = "Universidad";
        $this->con = new DBConexion($this->Usuario, $this->Clave);
        $_SESSION['conexion']=$this->con;
        return 2;
      }else if ($this->row['rol']===3 || $this->row['rol']==="3") {
        $this->Usuario = "Alumno";
        $this->Clave = "alumnoumes";
        $this->BaseDatos = "Universidad";
        $this->con = new DBConexion($this->Usuario, $this->Clave);
        $_SESSION['conexion']=$this->con;
        return 3;
      }else{
        return false;
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
    function crearPermiso($login , $tipousuario){
      $this->con->conectar();
      $this->usuario=$login;
      $this->tipo=$tipousuario;
      //$this->tipo=$tipousuario; tiene que ser el int que si es un catedratico es =2 admin=1  alumno=3 ese es un numero elq ue tiene 
      //que ingresar en tiposuario
      $this->query="INSERT INTO Asignacion_Permisos (login,rol) VALUES('".$this->usuario."',".$this->tipo.")";
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

    function verAlumnos(){
      $this->con->conectar();
      $this->query = "SELECT * FROM Alumnos;";
      $this->resultadoss = mysql_query($this->query);
    }

    function verAlumnosporCarnet($carnet){
      $this->con->conectar();
      $this->carnet=$carnet;
      $this->query = "SELECT * FROM Alumnos WHERE carnet = ".$this->carnet.";";
      $this->resultadoss = mysql_query($this->query);
    }

    function verAlumnosporNombre($nombre){
      $this->con->conectar();
      $this->nombre=$nombre;
      $this->query = "SELECT * FROM Alumnos WHERE nombre LIKE '%".$this->nombre."%';";
      $this->resultadoss = mysql_query($this->query);
    }

    function verNotasPorAlumnoSemestre($carnet, $semestre){
      $this->con->conectar();
      $this->carnet=$carnet;
      $this->semestre=$semestre;
      $this->query = "SELECT a.cod_curso, b.curso, a.semestre, c.Nota FROM Pensum a, Cursos b, Notas c WHERE c.carnet = ".$this->carnet." and a.cod_curso = b.idcurso and a.semestre =".$this->semestre.";";
      $this->resultado=mysql_query($this->query);
    }

    function verNotasPorAlumno($carnet){
      $this->con->conectar();
      $this->carnet=$carnet;
      $this->query = "SELECT a.cod_curso, b.curso, a.semestre, c.Nota FROM Pensum a, Cursos b, Notas c WHERE c.carnet = ".$this->carnet." and a.cod_curso = b.idcurso;";
      $this->resultado=mysql_query($this->query);
    }

    function verDependenciaDeCursos($carnet,$semestre){
      $this->con->conectar();
      $this->carnet=$carnet;
      $this->semestre=$semestre;
      $this->query = "SELECT COUNT(c.idcurso) FROM Pensum a, Cursos b, Notas c WHERE c.carnet = ".$this->carnet." and a.cod_curso = b.idcurso and a.semestre=".$this->semestre." and c.Nota=>61;";
      $this->resultado=mysql_query($this->query);
    }
?>