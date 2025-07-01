<?php
$host = 'localhost'; 
$usuario = 'rodrigo'; 
$contrasena = 'Password_rodrigo'; // agregamos la contraseña de la conexión
$base_de_datos = 'AGENCIA'; 
$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
$conexion->set_charset("utf8"); // agregamos compatibilidad para UTF8
