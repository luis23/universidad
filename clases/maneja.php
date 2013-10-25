<html>
<head>
</head>
<body>
<form method="POST">
<?php 
include "conexionpractica.class.php";
$user=$_POST['nombres'];
$pass=$_POST['contraseña'];
$conexion=new DBConexion($user,$pass);

$conexion->conectar();

?>
</form>
</body>
</html>
