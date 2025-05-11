<?php
session_start();

// Inicializar el carrito de compra si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Función para agregar un producto al carrito
function agregarAlCarrito($id, $nombre, $precio) {
    if (isset($_SESSION['carrito'][$id])) {
        // Si el producto ya está en el carrito, incrementar la cantidad
        $_SESSION['carrito'][$id]['cantidad']++;
    } else {
        // Agregar el producto al carrito
        $_SESSION['carrito'][$id] = [
            'nombre' => $nombre,
            'precio' => $precio,
            'cantidad' => 1
        ];
    }
}

// Función para eliminar un producto del carrito
function eliminarDelCarrito($id) {
    if (isset($_SESSION['carrito'][$id])) {
        unset($_SESSION['carrito'][$id]);
    }
}

// Función para calcular el total del carrito
function calcularTotal() {
    $total = 0;
    foreach ($_SESSION['carrito'] as $producto) {
        $total += $producto['precio'] * $producto['cantidad'];
    }
    return $total;
}

// Procesar la acción de agregar al carrito
if (isset($_GET['agregar'])) {
    $id = $_GET['id'];
    $nombre = $_GET['nombre'];
    $precio = $_GET['precio'];
    agregarAlCarrito($id, $nombre, $precio);
}

// Procesar la acción de eliminar del carrito
if (isset($_GET['eliminar'])) {
    $id = $_GET['id'];
    eliminarDelCarrito($id);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compra - Agencia de Viajes</title>
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
        <div class="row">
            <div class="col-md-12">
                <h1>Carrito de Compra</h1>
                <?php if (empty($_SESSION['carrito'])): ?>
                    <p>El carrito está vacío.</p>
                <?php else: ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['carrito'] as $id => $producto): ?>
                                <tr>
                                    <td><?= htmlspecialchars($producto['nombre']) ?></td>
                                    <td>$<?= htmlspecialchars($producto['precio']) ?></td>
                                    <td><?= htmlspecialchars($producto['cantidad']) ?></td>
                                    <td>$<?= htmlspecialchars($producto['precio'] * $producto['cantidad']) ?></td>
                                    <td>
                                        <a href="?eliminar=1&id=<?= htmlspecialchars($id) ?>" class="btn btn-danger">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <p>Total: $<?= htmlspecialchars(calcularTotal()) ?></p>
                <?php endif; ?>
            </div>
        </div>
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
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
