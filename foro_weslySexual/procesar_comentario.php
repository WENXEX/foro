<?php
session_start();

if (isset($_SESSION['usuario'])) {
    $id_sesion=$_SESSION['id_usuario'];
}else{
    header('Location: Login.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['comentario-usuario'];
    $contenido = $_POST['comentario-contenido'];
    $idPregunta = $_POST['id-pregunta']; 

    try {
        require("conexion.php");

        $stmt = $conexion->prepare("INSERT INTO respuestas (ID_preguntas, ID_usuario, contenido) 
                                    VALUES (:idPregunta, :usuario, :contenido)");
        $stmt->bindParam(':idPregunta', $idPregunta);
        $stmt->bindParam(':usuario', $id_sesion);
        $stmt->bindParam(':contenido', $contenido);

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