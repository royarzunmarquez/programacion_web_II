<?php
## Modificar y Renombrar como conecta.php
$host = 'localhost'; 
$usuario = 'usuario'; 
$contrasena = 'password'; 
$base_de_datos = 'AGENCIA'; 
$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
$conexion->set_charset("utf8");
