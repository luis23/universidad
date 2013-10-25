<?php 
	include 'manejador.class.php';
	$manejador=new Manejador();
	$resultado=$manejador->verAlumnos();
echo "<html>
				<head>
					<title>Ver Alumnos</title>
				</head>
				<body>
					<form>
						<fieldset>
							<legend>Ver Alumnos</legend>
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