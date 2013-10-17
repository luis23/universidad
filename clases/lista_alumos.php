<?php

/* Abrimos la base de datos */
$conx = mysql_connect ("localhost","administrador","admin");
  if (!$conx) die ("Error al abrir la base <br/>". mysql_error()); 
  mysql_select_db("bdprograweb") OR die("Connection Error to Database");    

/* Realizamos la consulta SQL */
$sql="select * from alumno";
$result= mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($result)==0) die("No hay registros para mostrar");

/* Desplegamos cada uno de los registros dentro de una tabla */  
echo "<table border=1 cellpadding=4 cellspacing=0>";

/*Priemro los encabezados*/
 echo "<tr>
         <th colspan=5> Lista Alumnos </th>
       <tr>
         <th> Numero de carne </th><th> Nombre </th><th> Apellido </th>
         <th> correo </th>
      </tr>";

/*Y ahora todos los registros */
while($row=mysql_fetch_array($result))
{
 echo "<tr
>         <td align='center'>".$row['nocarne']."</td>
         <td> ".$row['nombre'] ."</td>
         <td> ".$row['apellido']." </td>
         <td> ".$row['correo'] ."</td>
      </tr>";
}
echo "</table>";

?>