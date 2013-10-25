<html>
<head>
	<title>Crear Catedratico</title>
</head>
<body>
	<form>
<?php 
include 'manejador.class.php';

$idcatedrtico=$_POST['Id'];
$Nombre=$_POST['Nombre'];
$Correo=$_POST['Correo'];
$Telefono=$_POST['Telefono'];
$User=$_POST['Usuario'];
$Pass=$_POST['Pass']

$manejador=new Manejardor();

$resultado=$manejador->crearCatedratico($idcatedrtico, $Nombre, $Correo, $Telefono);
$resultado2=$manejador->crearUsuario($User,$pass);
$resultado3=$manejador->crearPermiso($User,$Permiso);


if($resultado & $resultado2 & $resultado3){
	echo "Se registro Correctamente";
}else{
	echo "No se pudo Registrar";
}

 ?>
 </form>
</body>
</html>