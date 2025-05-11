<?php
include 'conecta.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $fecha = $_POST['fecha'];
    $plazas_disponibles = $_POST['plazas_disponibles'];
    $precio = $_POST['precio'];

    // Validación básica en el servidor
    if (empty($origen) || empty($destino) || empty($fecha) || empty($plazas_disponibles) || empty($precio)) {
        die("Todos los campos son obligatorios.");
    }

    if (!is_numeric($plazas_disponibles) || $plazas_disponibles <= 0) {
        die("Las plazas disponibles deben ser un número mayor que cero.");
    }

    if (!is_numeric($precio) || $precio <= 0) {
        die("El precio debe ser un número mayor que cero.");
    }

    // Insertar datos en la base de datos
    $sql = "INSERT INTO VUELO (origen, destino, fecha, plazas_disponibles, precio) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssdi", $origen, $destino, $fecha, $plazas_disponibles, $precio);

    if ($stmt->execute()) {
        echo "Vuelo agregado exitosamente.";
    } else {
        echo "Error al agregar el vuelo: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>
