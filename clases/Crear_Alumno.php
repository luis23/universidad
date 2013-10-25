<html>
<head>
</head>
<body>
	<form method="POST">
<?php 

include "manejador.class.php";

$Carne=$_POST['Carne'];
$Nombre=$_POST['Nombre'];
$Direccion=$_POST['Direccion'];
$Direccion=$_POST['Direccion'];
$Correo=$_POST['Correo'];
$Sede=$_POST['Sede'];
$Pass=$_POST['Pass'];
$Permiso=$_POST['Permiso'];

$Manejador= new Manejador();

$resultado=$Manejador->crearAlumno($Carne, $Nombre, $Direccion, $Correo, $Sede);
$resultado2=$manejador->crearUsuario($Carne,$pass);
$resultado3=$manejador->crearPermiso($Carne,$Permiso);

if($resultado & $resultado2 & $resultado3){
	echo "Se registro Correctamente";
}else{
	echo "No se pudo Registrar";
}

 ?>
	</form>
</body>
</html>