<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST['Nombre'], $_POST['Apellido'], $_POST['CorreoElectronico'], $_POST['Contrasena']) && !empty($_POST['Nombre']) && !empty($_POST['Apellido']) && !empty($_POST['CorreoElectronico']) && !empty($_POST['Contrasena'])){
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellido'];
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
    $stmt = $conexion->prepare("INSERT INTO tbl_Usuario (Nombre, Apellido, CorreoElectronico, Contrasena) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $apellido, $correoElectronico, $contrasena);

    if($stmt->execute()) {
        echo "Registro exitoso";
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    // Cerrar la conexión y liberar los recursos
    $stmt->close();
    $conexion->close();
} else {
    echo "Todos los campos del formulario son obligatorios.";
}
}