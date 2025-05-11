<?php
session_start();

// Función para generar notificaciones de ofertas especiales
function generarNotificacionOferta() {
    $ofertas = [
        "¡Descuento del 20% en vuelos a Cancún!",
        "Reserva hoy y obtén un hotel gratis en tu próximo viaje.",
        "Últimos paquetes disponibles para el Caribe."
    ];
    $indice = array_rand($ofertas);
    return $ofertas[$indice];
}
$mensajeOferta = generarNotificacionOferta();

// Clase para manejar los destinos y las búsquedas
class FiltroViaje {
    private $destinos;

    public function __construct() {
        $this->destinos = [
            'Arica' => [
                'nombre_hotel' => 'Hotel del Norte',
                'pais' => 'Chile',
                'fecha_viaje' => '2025-11-15',
                'duracion_viaje' => 5
            ],
            'Santiago' => [
                'nombre_hotel' => 'Hotel Capital',
                'pais' => 'Chile',
                'fecha_viaje' => '2025-11-20',
                'duracion_viaje' => 7
            ],
            'Punta Arenas' => [
                'nombre_hotel' => 'Hotel Austral',
                'pais' => 'Chile',
                'fecha_viaje' => '2025-12-01',
                'duracion_viaje' => 10
            ]
        ];
    }

    public function buscarDestino($nombreDestino, $fechaViaje) {
        if (array_key_exists($nombreDestino, $this->destinos)) {
            $datosDestino = $this->destinos[$nombreDestino];

            // Validar que la fecha coincida
            if ($fechaViaje === $datosDestino['fecha_viaje']) {
                return [
                    'nombre_hotel' => $datosDestino['nombre_hotel'],
                    'pais' => $datosDestino['pais'],
                    'fecha_viaje' => $datosDestino['fecha_viaje'],
                    'duracion_viaje' => $datosDestino['duracion_viaje']
                ];
            } else {
                return "La fecha seleccionada no coincide con la fecha disponible para este destino.";
            }
        } else {
            return "El destino seleccionado no está disponible.";
        }
    }
}

// Variables para almacenar los resultados
$resultado = null;

// Procesar el formulario si se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $destinoSeleccionado = $_GET['destination'] ?? '';
    $fechaViaje = $_GET['travel-date'] ?? '';

    // Crear una instancia de la clase Destino
    $gestorDestinos = new FiltroViaje();

    // Buscar el destino y obtener los resultados
    $resultado = $gestorDestinos->buscarDestino($destinoSeleccionado, $fechaViaje);
}

// Procesar el formulario de login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $usuario = $_POST['usuario'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    // Validar credenciales (ejemplo básico)
    if ($usuario === 'admin' && $contrasena === '1234') {
        $_SESSION['usuario'] = $usuario;
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $errorLogin = "Credenciales inválidas.";
    }
}

// Cerrar sesión
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

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
    <title>Agencia de Viajes</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Barra Superior con Menú y Logo -->
    <?php include('nav.php'); ?>

    <!-- Modal de Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Iniciar sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if (isset($errorLogin)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($errorLogin) ?></div>
                    <?php endif; ?>
                    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="login">Iniciar sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Cuerpo Principal -->
    <main class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h1>Bienvenido a la Agencia de Viajes</h1>
                <p>Explora nuestros destinos y encuentra las mejores ofertas.</p>

                <!-- Contenedor para la notificación emergente -->
                <div id="notificacion" class="alert alert-success alert-dismissible fade show top-0 end-0 m-3" role="alert" style="z-index: 1000;">
                    <strong>¡Oferta Especial!</strong> <?php echo htmlspecialchars($mensajeOferta); ?>
                </div>

                <!-- Formulario de búsqueda -->
                <form class="search-container d-flex gap-2" action="#" method="GET">
                    <!-- Campo de entrada para el destino -->
                    <div class="flex-grow-1">
                        <select class="form-select" id="destination" name="destination" required>
                            <option value="" disabled selected>Selecciona un destino</option>
                            <option value="Arica">Arica</option>
                            <option value="Santiago">Santiago</option>
                            <option value="Punta Arenas">Punta Arenas</option>
                        </select>
                    </div>

                    <!-- Campo de entrada para la fecha -->
                    <div class="flex-grow-1">
                        <input type="date" class="form-control" id="travel-date" name="travel-date" required>
                    </div>

                    <!-- Botón de búsqueda -->
                    <button type="submit" class="btn btn-primary" id="search-btn">Buscar</button>
                </form>

                <!-- Resultado de la búsqueda -->
                <?php if ($resultado): ?>
                    <div class="mt-4">
                        <?php if (is_array($resultado)): ?>
                            <h3>Resultados de la Búsqueda:</h3>
                            <p><strong>Hotel:</strong> <?= htmlspecialchars($resultado['nombre_hotel']) ?></p>
                            <p><strong>País:</strong> <?= htmlspecialchars($resultado['pais']) ?></p>
                            <p><strong>Fecha de Viaje:</strong> <?= htmlspecialchars($resultado['fecha_viaje']) ?></p>
                            <p><strong>Duración del Viaje:</strong> <?= htmlspecialchars($resultado['duracion_viaje']) ?> días</p>
                            <a href="?agregar=1&id=<?= htmlspecialchars(uniqid()) ?>&nombre=<?= htmlspecialchars($resultado['nombre_hotel']) ?>&precio=100" class="btn btn-success">Agregar al carrito</a>
                        <?php else: ?>
                            <p class="text-danger"><?= htmlspecialchars($resultado) ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Carrito de Compra -->
                <div class="mt-5">
                    <h2>Carrito de Compra</h2>
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
    <!-- Script JavaScript para mostrar la notificación -->
    <script>
        window.onload = function() {
            const notificacion = document.getElementById('notificacion');
            if (notificacion) {
                notificacion.style.display = 'block';
                setTimeout(() => {
                    notificacion.classList.remove('show');
                    setTimeout(() => {
                        notificacion.style.display = 'none';
                    }, 500);
                }, 5000);
            }
        };
    </script>
</body>
</html>



