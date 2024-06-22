<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $nombre = $_POST["nombre"];
    $fechadenacimiento = $_POST["fechadenacimiento"];
    $correo = $_POST["correo"];
    $contraseña = $_POST["contraseña"];

    $imagen_pregunta = null;
    if ( $_FILES["avatar"]['error'] == 0) {

        $ruta_destino_pregunta = "perfil/" . basename($_FILES["avatar"]['name']);
        move_uploaded_file($_FILES["avatar"]["tmp_name"], $ruta_destino_pregunta);
        $imagen_pregunta = $ruta_destino_pregunta;
    }
    require 'conexion.php';
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, fecha_nacimiento, email, contrasena, avatar) 
    VALUES (:nombre, :fechadenacimiento, :correo, :contrasena, :avatar)");

    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':fechadenacimiento', $fechadenacimiento);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':contrasena', $contraseña);
    $stmt->bindParam(':avatar', $ruta_destino_pregunta);
    $stmt->execute();

    echo "<h2>¡¡¡Registro Exitoso!!!</h2>";
    header("Location: Login.php");
    exit();
    $conexion = null;
}
?>