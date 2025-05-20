<?php
session_start();

// Cerrar sesión
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Incluir el archivo de conexión a la base de datos
require_once 'conecta.php';

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para obtener todos los registros de la tabla VUELO
$sql = "SELECT id_vuelo, origen, destino, fecha, plazas_disponibles, precio FROM VUELO";
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agencia de Viajes - Vuelos</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Barra Superior con Menú y Logo -->
    <?php include('nav.php'); ?>

    <!-- Cuerpo Principal -->
    <main class="container mt-4">
        <h1>Gestionar Vuelos</h1>
        <form action="procesar_vuelo.php" method="POST" onsubmit="return validarFormularioVuelo()">
            <div class="form-group">
                <label for="origen">Origen:</label>
                <input type="text" class="form-control" id="origen" name="origen" required>
            </div>
            <div class="form-group">
                <label for="destino">Destino:</label>
                <input type="text" class="form-control" id="destino" name="destino" required>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="form-group">
                <label for="plazas_disponibles">Plazas Disponibles:</label>
                <input type="number" class="form-control" id="plazas_disponibles" name="plazas_disponibles" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Vuelo</button>
        </form>
        <br>

        <h2 class="text-center mb-4">Lista de Vuelos</h2>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID Vuelo</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Fecha</th>
                    <th>Plazas Disponibles</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id_vuelo']}</td>
                                <td>{$row['origen']}</td>
                                <td>{$row['destino']}</td>
                                <td>{$row['fecha']}</td>
                                <td>{$row['plazas_disponibles']}</td>
                                <td>{$row['precio']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No hay registros disponibles</td></tr>";
                }
                ?>
            </tbody>
        </table>
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
    <script src="java_vuelos.js"></script>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conexion->close();
?>
