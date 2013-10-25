<html>
<head>
</head>
<body>
<form method="POST">
<?php 
include "manejador.class.php";
$user=$_POST['nombres'];
$pass=$_POST['contraseña'];
$conexion=new Manejador();
$resultado=$conexion->loginUsuario($user,$pass);

if ($resultado===1) {
echo "admin";
}
elseif($resultado===2){
	echo "catedratico";
}elseif ($resultado===3) {
echo "alumno";
}


?>
</form>
</body>
</html>
