<?php
include 'conecta.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $ubicacion = $_POST['ubicacion'];
    $habitaciones_disponibles = $_POST['habitaciones_disponibles'];
    $tarifa_noche = $_POST['tarifa_noche'];

    // Validación básica en el servidor
    if (empty($nombre) || empty($ubicacion) || empty($habitaciones_disponibles) || empty($tarifa_noche)) {
        die("Todos los campos son obligatorios.");
    }

    if (!is_numeric($habitaciones_disponibles) || $habitaciones_disponibles <= 0) {
        die("Las habitaciones disponibles deben ser un número mayor que cero.");
    }

    if (!is_numeric($tarifa_noche) || $tarifa_noche <= 0) {
        die("La tarifa por noche debe ser un número mayor que cero.");
    }

    // Insertar datos en la base de datos
    $sql = "INSERT INTO HOTEL (nombre, ubicación, habitaciones_disponibles, tarifa_noche) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssdi", $nombre, $ubicacion, $habitaciones_disponibles, $tarifa_noche);

    if ($stmt->execute()) {
        echo "Hotel agregado exitosamente.";
    } else {
        echo "Error al agregar el hotel: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>
