<?php
$db_host="localhost";
$db_nombre="autos_xxi";
$db_usuario="root";
$db_pass="";

error_reporting(0);

$conexion= new mysqli($db_host,$db_usuario,$db_pass,
$db_nombre);



if ($conexion->connect_errno) {
    echo "Error en la conexion<br>";
}


mysqli_select_db($conexion, $db_nombre) or die ("Base de datos no encontrada");

mysqli_set_charset($conexion,"utf8");

?>
