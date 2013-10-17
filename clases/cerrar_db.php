<?php  
$conx = mysql_connect ("localhost","administrador","admin");
  if (!$conx) die ("Error al abrir la base <br/>". mysql_error()); 
  mysql_select_db("bdprograweb") OR die("Connection Error to Database");    
$cerrar=mysql_close($conx);
if($cerrar){
echo "<meta http-equiv=\"Refresh\" content=\"0; url=http://localhost/webs/proyecto/html/login.html\">";
		}else{
			echo "no se cerro";
		}
?>