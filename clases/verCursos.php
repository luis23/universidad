<?php 
include 'manejador.class.php';
	$carrera=$_POST['carrera'];
	$manejador=new Manejador();
	$resultado=$manejador->verCursosPorCarrera($carrera);
	echo "<html>
				<head>
					<title>Ver Carreras</title>
				</head>
				<body>
					<form class=\"form1\" method=\"post\" action=\"vercarreras.php\">
						<fieldset>
							<legend>Ver Carreras</legend>
								<div class=\"control-group\">
			  						<label>Cursos de ".$carrera.":</label><br>
			  						<label>Semestre 1</label><br>";

	while ($row = mysql_fetch_array($resultado)) {
		if($row['semestre']==="1"){
			echo "<TABLE class= \"tabla\" BORDER=1 WIDTH=300><tr WIDTH=300><td WIDTH=300>".$row['cod_curso']."</td><td WIDTH=300>".$row['curso']."</td></tr></TABLE>";
		}
	}
	echo "<br><label>Semestre 2</label><br>";
	while ($row = mysql_fetch_array($resultado)) {
		if($row['semestre']==="2"){
			echo "<TABLE class= \"tabla\" BORDER=1 WIDTH=300><tr WIDTH=300><td WIDTH=300>".$row['cod_curso']."</td><td WIDTH=300>".$row['curso']."</td></tr></TABLE>";
		}
	}
	echo "<br><label>Semestre 3</label><br>";
	while ($row = mysql_fetch_array($resultado)) {
	if($row['semestre']==="3"){
		echo "<TABLE class= \"tabla\" BORDER=1 WIDTH=300><tr WIDTH=300><td WIDTH=300>".$row['cod_curso']."</td><td WIDTH=300>".$row['curso']."</td></tr></TABLE>";
		}
	}
	echo "<br><label>Semestre 4</label><br>";
	while ($row = mysql_fetch_array($resultado)) {
		if($row['semestre']==="4"){
			echo "<TABLE class= \"tabla\" BORDER=1 WIDTH=300><tr WIDTH=300><td WIDTH=300>".$row['cod_curso']."</td><td WIDTH=300>".$row['curso']."</td></tr></TABLE>";
		}	
	}
	echo "<br><label>Semestre 5</label><br>";
	while ($row = mysql_fetch_array($resultado)) {
		if($row['semestre']==="5"){
			echo "<TABLE class= \"tabla\" BORDER=1 WIDTH=300><tr WIDTH=300><td WIDTH=300>".$row['cod_curso']."</td><td WIDTH=300>".$row['curso']."</td></tr></TABLE>";
		}
	}
	echo "<br><label>Semestre 6</label><br>";
	while ($row = mysql_fetch_array($resultado)) {
		if($row['semestre']==="6"){
			echo "<TABLE class= \"tabla\" BORDER=1 WIDTH=300><tr WIDTH=300><td WIDTH=300>".$row['cod_curso']."</td><td WIDTH=300>".$row['curso']."</td></tr></TABLE>";
		}
	}
	echo "<br><label>Semestre 7</label><br>";
	while ($row = mysql_fetch_array($resultado)) {
		if($row['semestre']==="7"){
			echo "<TABLE class= \"tabla\" BORDER=1 WIDTH=300><tr WIDTH=300><td WIDTH=300>".$row['cod_curso']."</td><td WIDTH=300>".$row['curso']."</td></tr></TABLE>";
		}
	}
	echo "<br><label>Semestre 8</label><br>";
	while ($row = mysql_fetch_array($resultado)) {
			if($row['semestre']==="8"){
			echo "<TABLE class= \"tabla\" BORDER=1 WIDTH=300><tr WIDTH=300><td WIDTH=300>".$row['cod_curso']."</td><td WIDTH=300>".$row['curso']."</td></tr></TABLE>";
		}
	}
	echo "<br><label>Semestre 9</label><br>";
	while ($row = mysql_fetch_array($resultado)) {
			if($row['semestre']==="9"){
			echo "<TABLE class= \"tabla\" BORDER=1 WIDTH=300><tr WIDTH=300><td WIDTH=300>".$row['cod_curso']."</td><td WIDTH=300>".$row['curso']."</td></tr></TABLE>";
		}
	}
	echo "<br><label>Semestre 10</label><br>";
	while ($row = mysql_fetch_array($resultado)) {
			if($row['semestre']==="10"){
			echo "<TABLE class= \"tabla\" BORDER=1 WIDTH=300><tr WIDTH=300><td WIDTH=300>".$row['cod_curso']."</td><td WIDTH=300>".$row['curso']."</td></tr></TABLE>";
		}
	}
	echo "<br><input type=\"submit\" value=\"Regresar\"></div>
			</fieldset>
			</form>
			</body>
			</html>";
 ?>