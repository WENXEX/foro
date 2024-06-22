<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header('Location: foro.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    try {
        require("conexion.php");

        $statement = $conexion->prepare("SELECT * FROM usuarios WHERE email=:correo");
        $statement->execute(['correo' => $correo]);
        $user = $statement->fetch();

        if (!$user || !($contrasena== $user["contrasena"])) {
            echo "Login inválido" . "<br>";
            echo "<a href='Login.html'>Volver al inicio de sesión</a>";
        } else {
            $_SESSION['usuario'] = $user["email"];
            $_SESSION['id_usuario'] = $user["id"];
            header("Location: foro.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
} else {
    header("Location: Login.php");
    exit();
}
?>