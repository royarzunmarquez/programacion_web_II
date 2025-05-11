<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container-fluid">
            <!-- Logo de la Empresa -->
            <a class="navbar-brand" href="index.php">
                <img src="logo.png" alt="Logo">
            </a>
            <!-- Botón para colapsar el menú en dispositivos pequeños -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Menú contextual -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                    <?php if (isset($_SESSION['usuario'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="vuelos.php">Gestionar Vuelos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="hoteles.php">Gestionar Hoteles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reservas.php">Ver Reservas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?logout=1">Cerrar sesión</a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?></span>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#loginModal" href="login.php">Iniciar sesión</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>