<?php
session_start();

// Procesar el formulario de login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $usuario = $_POST['usuario'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    // Validar credenciales (ejemplo básico)
    if ($usuario === 'admin' && $contrasena === '1234') {
        $_SESSION['usuario'] = $usuario;
        header('Location: index.php'); // Redirigir a la página principal después de iniciar sesión
        exit;
    } else {
        $errorLogin = "Credenciales inválidas.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Agencia de Viajes</title>
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
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1>Iniciar Sesión</h1>
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
