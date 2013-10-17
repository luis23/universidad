             
<?php 
$conx = mysql_connect ("localhost","administrador","admin");
  if (!$conx) die ("Error al abrir la base <br/>". mysql_error()); 
  mysql_select_db("bdprograweb") OR die("Connection Error to Database");    

 
if(isset($_POST['enviar'])) 
{ 
    if($_POST['usuario'] == '' or $_POST['password'] == '' or $_POST['repassword'] == '' or $_POST['carne']== '' or $_POST['apellido']== '' or $_POST['correo']== '') 
    { 
        echo "
        <html>
                <head>
                    <title>claves</title>
                        <meta http-equiv=\"Refresh\" content=\"2;url=http://localhost/webs/proyecto/html/crear_alumno.html\">
                </head>
                <body>
                <h1>Por favor llene todos los campos.</h1>
                </body>
                </html>
                "; 
    } 
    else 
    { 
        $sql = "select * from alumno"; 
        $rec = mysql_query($sql); 
        $verificar_usuario = 0; 
        while($result = mysql_fetch_object($rec)) 
        { 
            if($result->alumno == $_POST['usuario']) 
            { 
                $verificar_usuario = 1; 
            } 
        } 
  
        if($verificar_usuario == 0) 
        { 
            if($_POST['password'] == $_POST['repassword']) 
            { 
                $usuario = $_POST['usuario']; 
                $password = $_POST['password']; 
                $carne=$_POST['carne'];
                $apellido= $_POST['apellido'];
                $correo= $_POST['correo'];
                echo "$correo, $password, $carne";
                $sql = "insert into alumno values ('".$carne."','".$usuario."','".$apellido."','".$correo."','".$password."')";
                $sql2= "insert into usuario values ('".$carne."','".$password."')" ;
                $resultado=mysql_query($sql);
                $resultado2=mysql_query($sql2);
                if($resultado && $resultado2){
                    echo "true";

                    echo "
                <html>
                <head>
                    <title>claves</title>
                    <meta http-equiv=\"Refresh\" content=\"20;url=http://localhost/webs/proyecto/html/crear_alumno.html\">
                </head>
                <body>
                <h1> Se registro.</h1>
                </body>
                </html>"; 

                }else{
                    echo "falso";
                    echo "
                <html>
                <head>
                    <title>claves</title>
                    <meta http-equiv=\"Refresh\" content=\"20;url=http://localhost/webs/proyecto/html/crear_alumno.html\">
                </head>
                <body>
                <h1> falso</h1>
                </body>
                </html>"; 
                }
                
                 
            } 
            else 
            { 
                echo "
                <html>
                <head>
                    <title>claves</title>
                    <meta http-equiv=\"Refresh\" content=\"20;url=http://localhost/webs/proyecto/html/crear_alumno.html\">
                </head>
                <body>
                <h1>Las claves no son iguales, intente nuevamente.</h1>
                </body>
                </html>"; 
            } 
        } 
        else 
        { 
          echo "
                <html>
                <head>
                    <title>claves</title>
                    <meta http-equiv=\"Refresh\" content=\"10;url=http://localhost/webs/proyecto/html/crear_alumno.html\">
                </head>
                <body>
                <h1>Este usuario ya ha sido registrado anteriormente.</h1>
                </body>
                </html>"; 
        } 
        
    } 
} 
?> 