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
    <title>Agencia de Viajes - Vuelos</title>
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



