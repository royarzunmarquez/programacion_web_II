<?php
session_start();

// Cerrar sesión
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agencia de Viajes - Hoteles</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Barra Superior con Menú y Logo -->
    <?php include('nav.php'); ?>


    <!-- Cuerpo Principal -->
    <main class="container mt-4">
    <?php
include 'conecta.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas Registradas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Reservas Registradas</h2>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID Reserva</th>
                    <th>ID Cliente</th>
                    <th>Fecha Reserva</th>
                    <th>ID Vuelo</th>
                    <th>ID Hotel</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta simple para mostrar el contenido de la tabla RESERVA
                $sql = "SELECT * FROM RESERVA";
                $resultado = $conexion->query($sql);

                if ($resultado->num_rows > 0) {
                    while($fila = $resultado->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $fila["id_reserva"]. "</td>
                                <td>" . $fila["id_cliente"]. "</td>
                                <td>" . $fila["fecha_reserva"]. "</td>
                                <td>" . $fila["id_vuelo"]. "</td>
                                <td>" . $fila["id_hotel"]. "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No hay reservas registradas.</td></tr>";
                }

                $conexion->close();
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

        <br>
    </main>

    

    <!-- Pie de Página -->
    <footer>
        <div class="container text-center">
            <p>&copy; <?php echo date('Y'); ?> Nombre de la Empresa. Todos los derechos reservados.</p>
            <p>
                <a href="#">Política de Privacidad</a> |
                <a href="#">Términos de Servicio</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Script JavaScript -->
</body>
</html>



