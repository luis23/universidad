<?php 
include 'manejador.class.php';


$carnet=$_POST['carnet'];
$manejador=new Manejador();

//$resultado=$manejador->verAlumnosporCarnet($carnet);

$resulta2=$manejador->verNotasPorAlumno($carnet);


echo "<html>
				<head>
					<title>Buscar Alumnos por Carnet</title>
				</head>
				<body>
					<form>
						<fieldset>
							<legend>Buscar Alumnos por Carnet</legend>
								<div>";


	/*while ($row = mysql_fetch_array($resultado)) {
		echo "
			<tr>
		 		<td>".$row['carnet']."</td>
         		<td> ".$row['nombre'] ."</td>
      		</tr>";

		
	}
	*/
	while ($row2=mysql_fetch_array($resulta2)) {
		echo"
			<tr>
				<td>".$row['carnet']."</td>
		 		<td>".$row['curso']."</td>
        		<td> ".$row['nota'] ."</td>
        		<td> ".$row['semestre'] ."</td>
        	</tr>";
	}
		echo "<br><input type=\"submit\" value=\"Regresar\"></div>
			</fieldset>
			</form>
			</body>
			</html>";



 ?>