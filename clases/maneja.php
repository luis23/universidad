<html>
<head>
</head>
<body>
<form method="POST">
<?php 
include "conexion.class.php";
$user=$_POST['nombres'];
$pass=$_POST['contraseña'];
$conexion=new conexion($user,$pass);

$conexion->conectar();

?>
</form>
</body>
</html>
