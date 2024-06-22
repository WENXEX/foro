<?php
session_start();

if (isset($_SESSION['usuario'])) {
    $id_sesion=$_SESSION['id_usuario'];
}else{
    header('Location: Login.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['post-title'];
    $contenido = $_POST['post-content'];

    if (isset($_FILES["post-image"]) && $_FILES["post-image"]["error"] == 0) {
        $imagen_nombre = $_FILES["post-image"]["name"];
        $imagen_temp = $_FILES["post-image"]["tmp_name"];
        $imagen_destino = "imagen/" . uniqid() . "_" . $imagen_nombre;
        move_uploaded_file($imagen_temp, $imagen_destino);
    } else {
        $imagen_destino = null;
    }

    try {
        require("conexion.php");

        $stmt = $conexion->prepare("INSERT INTO preguntas (ID_usuario, titulo, contenido, imagen_pregunta) 
        VALUES (:id_usuario, :titulo, :contenido, :imagen)");
        $stmt->bindParam(':id_usuario', $id_sesion);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':contenido', $contenido);
        $stmt->bindParam(':imagen', $imagen_destino, PDO::PARAM_STR);
        $stmt->execute();
        header("Location: foro.php");
        exit();
        $conexion = null;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
} else {

    header("Location: foro.php");
    exit();
}
?>