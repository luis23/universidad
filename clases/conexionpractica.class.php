<?php 
class DBConexion {

    private $con;
    private $db;
    private $dbhost;
    private $user;
    private $password;
    
    function DBConexion ($usuario, $pass) {
        $this->db = "Universidad";
        $this->dbhost = "localhost";
        $this->user = $usuario;
        $this->password = $pass;
    }

    function conectar() {
        if (!($this->con = @mysql_connect($this->dbhost, $this->user, $this->password))) {
            echo"<OPTION> [:(] Error al conectar a la base de datos</OPTION>";
                echo "<meta http-equiv="Refresh" content="5;url="http://localhost/webs/universidad/plantillas/cursos/ver_cursos.html">";
            exit();
        }
        if (!@mysql_select_db($this->db, $this->con)) {
            echo "<OPTION> [:(] Error al seleccionar la base de datos ".mysql_error()."</OPTION>";
            exit();
        }
        return $this->con;
    }
    function closeConection(){
        msql_close($this->con);
    }
}
 ?>