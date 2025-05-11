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
    <h2 class="text-center">Agregar Hotel</h2><br>
        <form action="procesar_hotel.php" method="POST" onsubmit="return validarFormularioHotel()">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="ubicacion">Ubicación:</label>
                <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
            </div>
            <div class="form-group">
                <label for="habitaciones_disponibles">Habitaciones Disponibles:</label>
                <input type="number" class="form-control" id="habitaciones_disponibles" name="habitaciones_disponibles" required>
            </div>
            <div class="form-group">
                <label for="tarifa_noche">Tarifa por Noche:</label>
                <input type="number" step="0.01" class="form-control" id="tarifa_noche" name="tarifa_noche" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Hotel</button>
        </form>
        <br>
        <h2 class="text-center">Hoteles con Más de Dos Reservas</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Hotel</th>
                    <th>Nombre</th>
                    <th>Ubicación</th>
                    <th>Número de Reservas</th>
                </tr>
            </thead>
            <tbody>
                <?php include 'consulta_hoteles.php'; ?>
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
    <script src="java_hoteles.js"></script>

</body>
</html>



