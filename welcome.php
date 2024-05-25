<?php
session_start();

if (!isset($_SESSION['id_Usuario'])) {
    header("Location: index.html");
    exit();
}

$nombreCompleto = $_SESSION['Nombre'] . ' ' . $_SESSION['Apellido'];
$correoElectronico = $_SESSION['correoElectronico'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Estilos CSS -->
    <link rel="stylesheet" href="css/Welcome.css" />
    <link rel="stylesheet" href="css/Shop.css" />
    <!-- Icono -->
    <link rel="shortcut icon" href="img/Captura-removebg-preview.png" type="image/x-icon">
    <title>Welcome Usuario😎</title>

    <!-- Animacion de pantalla -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <div class="contenedorGeneral">
        <div>
            <!-- Logos de David y Kevin -->
            <div class="contenedorImagenes">
                <img class="image-left logo1" src="img/Logo_Kevin-removebg-preview.png" alt="Imagen Izquierda" />
                <img class="image-right logo2" src="img/Logo_David-removebg-preview.png" alt="Imagen Derecha" />
            </div>

            <!-- Video de fondo -->
            <video autoplay muted loop id="video-background">
                <source src="video/Space.mp4" type="video/mp4" />
            </video>

            <!-- Start Banner Hero -->
            <div class="message">
                <div class="content-container">
                    <h1>Bienvenido <?php echo htmlspecialchars($nombreCompleto, ENT_QUOTES, 'UTF-8'); ?>:</h1>
                    <p>¡Gracias por visitar nuestro sitio web!.</p>
                    <h2>Su correo es:</h2>
                    <p><?php echo htmlspecialchars($correoElectronico, ENT_QUOTES, 'UTF-8'); ?></p>
                    <h2>Equipo de Trabajo</h2>
                    <p>Kevin Julian Guerrero Penagos</p>
                    <p>David Alejandro Camacho León</p>
                    <h2>Materia</h2>
                    <p>Arquitectura Plataformas Tecnologicas</p>
                    <p>Id: 821270</p>
                    <p>Id: 894035</p>
                    <p>Muchas Gracias por su atención</p>
                </div>
            </div>
            <!-- Formulario y script para cerrar sesión -->
            <form id="logoutForm" action="Registrar/logout.php" method="post">
                <button class="neon-button" type="submit">Cerrar Sesión</button>
            </form>
        </div>
    </div>
</body>
</html>