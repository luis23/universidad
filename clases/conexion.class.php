<?php 
/*
* by:brayan :D
*/
class conexion
{


	function conexion($user,$pass)
	{
		$this->host="localhost";
		$this->user=$user;
		$this->pass=$pass;
		$this->db="Universidad";
	}
	function conectar(){
		if(isset($_POST['enviar'])){

if($this->user == '' or $this->pass== ''){ 
        echo "
        <html>
                <head>
                    <title>claves</title>
                        <meta http-equiv=\"Refresh\" content=\"2;url=http://localhost/webs/proyecto/html/login.html\">
                </head>
                <body>
                <h1>Por favor llene todos los campos.</h1>
                </body>
                </html>
                "; 
    } 
    else 
    { 
		if(($con=@mysql_connect($this->host,$this->user,$this->pass))){
			echo "<meta http-equiv=\"Refresh\" content=\"0; url=http://localhost/webs/proyecto/html/home.html\">";
		}
		if(!($con=@mysql_connect($this->host,$this->user,$this->pass))){
			#echo"
			#<meta content='text/html; charset=utf-8' http-equiv='content-type'>
			#<h1> Error Usuario O Contraseña Incorrecta </h1>
			#<meta http-equiv=\"Refresh\" content=\"2; url=http://localhost/webs/proyecto/html/login.html\">";	
			

		exit();
		}
		if (!@mysql_select_db($this->db,$con)){
			#si la base de datos no se conecto hace esto
			echo "
			<meta http-equiv=\"Refresh\" content=\"2; url=http://localhost/webs/proyecto/html/login.html\">
			";  
		exit();
		}
		$this->conect=$con;
		return true;	
	}
	}
}
}

#Conectamos con MySQL
#$conexion = mysql_connect($host,$user,$pass);
#or die ("Fallo en el establecimiento de la conexion");

#Seleccionamos la base de datos a utilizar
#mysql_select_db($db,$conexion);
#or die("Error en la selección de la base de datos");
 
#if ($conexion) {
#	header('Location: ../login.html');
#}
#if (!$conexion) {
#	header('Location: ../login-error.html');
#}
# ################################### #
# Aquí insertaríamos las consultas sobre la base de datos #
# ################################### #

#Cerramos la conexión con la base de datos
#mysql_close($conexion);

 ?>