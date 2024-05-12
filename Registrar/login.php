<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['CorreoElectronico'], $_POST['Contrasena']) && !empty($_POST['CorreoElectronico']) && !empty($_POST['Contrasena'])){
        $correoElectronico = $_POST['CorreoElectronico'];
        $contrasena = $_POST['Contrasena'];
        
        // Validar que las contraseñas coincidan
        //if($contrasena != $contrasenaRepetida) {
        //   echo "Las contraseñas no coinciden.";
        //exit; // Detener la ejecución del script si las contraseñas no coinciden
        //}

        // Realizar cualquier otra validación necesaria aquí

        // Conectar a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'Usuario');

        if($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Insertar los datos en la base de datos
        $stmt = $conexion->prepare("SELECT id_Usuario, Nombre FROM tbl_Usuario WHERE CorreoElectronico = ? AND Contrasena = ?");
        $stmt->bind_param("ss", $correoElectronico, $contrasena);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows == 1) {
            // Inicio de sesión exitoso
            $usuario = $resultado->fetch_assoc();
            echo "Inicio de sesión exitoso. ¡Bienvenido, " . $usuario['Nombre'] . "!";

        // Cerrar la conexión y liberar los recursos
        
        }else {
            echo "Correo electrónico o contraseña incorrectos. Por favor, inténtalo de nuevo.";
        }
    }
}

$stmt->close();
$conexion->close();