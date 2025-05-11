<?php
include 'conecta.php';

// Consulta avanzada para calcular el número de reservas por hotel y mostrar los hoteles con más de dos reservas
$sql = "SELECT H.id_hotel, H.nombre, H.ubicación, COUNT(R.id_hotel) AS num_reservas
        FROM HOTEL H
        JOIN RESERVA R ON H.id_hotel = R.id_hotel
        GROUP BY H.id_hotel, H.nombre, H.ubicación
        HAVING num_reservas > 2";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    while($fila = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>" . $fila["id_hotel"]. "</td>
                <td>" . $fila["nombre"]. "</td>
                <td>" . $fila["ubicación"]. "</td>
                <td>" . $fila["num_reservas"]. "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No hay hoteles con más de dos reservas.</td></tr>";
}

$conexion->close();
?>
