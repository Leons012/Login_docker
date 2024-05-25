<?php
session_start(); // Inicia la sesión

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['CorreoElectronico'], $_POST['Contrasena']) && !empty($_POST['CorreoElectronico']) && !empty($_POST['Contrasena'])){
        $correoElectronico = $_POST['CorreoElectronico'];
        $contrasena = $_POST['Contrasena'];

        try {
            // Conectar a la base de datos utilizando PDO
            $conexion = new PDO('mysql:host=db;dbname=Usuario', 'root', '1234');
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Preparar la consulta SQL para seleccionar datos
            $stmt = $conexion->prepare("SELECT id_Usuario, Nombre, Apellido, correoElectronico FROM tbl_Usuario WHERE CorreoElectronico = ? AND Contrasena = ?");
            $stmt->execute([$correoElectronico, $contrasena]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                // Inicio de sesión exitoso
                $_SESSION['id_Usuario'] = $resultado['id_Usuario'];
                $_SESSION['Nombre'] = $resultado['Nombre'];
                $_SESSION['correoElectronico'] = $resultado['correoElectronico'];
                $_SESSION['Apellido'] = $resultado['Apellido'];
                header("Location: /welcome.php");
                exit();
            } else {
                echo "Correo electrónico o contraseña incorrectos. Por favor, inténtalo de nuevo.";
            }
        } catch(PDOException $e) {
            echo "Error al iniciar sesión: " . $e->getMessage();
        }
        
        // Cerrar la conexión (no es necesario en PDO, pero se incluye por buenas prácticas)
        unset($conexion);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login y Registro con HTML5 y CSS3</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <!-- Animación de pantalla -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Script JavaScript para evitar que el usuario regrese a la página de inicio de sesión después de iniciar sesión -->
    <script>
        // Reemplazar el estado actual para evitar la navegación hacia atrás
        window.history.replaceState(null, '', window.location.href);
        window.onpopstate = function(event) {
            window.history.replaceState(null, '', window.location.href);
        };

        document.addEventListener('DOMContentLoaded', (event) => {
            history.pushState(null, '', location.href);
            window.onpopstate = function () {
                history.pushState(null, '', location.href);
            };
        });
    </script>
</head>
<body class="container animate__animated animate__fadeInDown">
    <main>
        <article>
            <section>
                <form action="login.php" method="POST">
                    <h1>Inicia Sesión</h1>
                    <img src="../icons-social/facebook.svg" title="Inicia Sesion con Facebook" alt="Inicia Sesion con Facebook">
                    <img src="../icons-social/google.svg" title="Inicia Sesion con Google" alt="Inicia Sesion con Google">
                    <img src="../icons-social/twitter.svg" title="Inicia Sesion con Twitter" alt="Inicia Sesion con Twitter">
                    <img src="../icons-social/github.svg" title="Inicia Sesion con GitHub" alt="Inicia Sesion con GitHub">

                    <!-- Campo de correo electrónico -->
                    <input type="email" name="CorreoElectronico" placeholder="Correo electr&oacute;nico" required><br/>

                    <!-- Campo de contraseña -->
                    <input type="password" name="Contrasena" placeholder="Contrase&ntilde;a" required><br/>

                    <!-- Botón para enviar el formulario -->
                    <button type="submit">Entrar</button>

                    <!-- Botón para limpiar los campos del formulario -->
                    <button type="reset">Limpiar</button>

                    <p>Aún no tienes cuenta?</p>
                    <p><a href="../register.html">Regístrate</a></p>
                </form>
            </section>
        </article>
    </main>
</body>
</html>
