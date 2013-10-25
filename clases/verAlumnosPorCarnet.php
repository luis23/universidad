
<?php 
include 'manejador.class.php';


$carnet=$_POST['carnet'];
$manejador=new Manejador();
$resultado=$manejador->verAlumnosporCarnet($carnet);
echo "<html>
				<head>
					<title>Buscar Alumnos por Carnet</title>
				</head>
				<body>
					<form>
						<fieldset>
							<legend>Buscar Alumnos por Carnet</legend>
								<div>";


	while ($row = mysql_fetch_array($resultado)) {
			echo "<tr>
		 <td>".$row['carnet']."</td>
         <td> ".$row['nombre'] ."</td>
         <td> ".$row['direccion']." </td>
         <td> ".$row['correo'] ."</td>
         <td> ".$row['sede'] ."</td>
      </tr>";

		
	}
		echo "<br><input type=\"submit\" value=\"Regresar\"></div>
			</fieldset>
			</form>
			</body>
			</html>";


 ?>
