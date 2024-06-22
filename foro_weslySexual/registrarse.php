<?php
session_start();
if (isset($_SESSION["usuario"])) {
  $usuarioActivo = $_SESSION["usuario"];
  $id_sesion = $_SESSION['id_usuario'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="header.css">
    
</head>

<body>

<header>
    <h1>Registro</h1>
    <nav>
    <ul>
                <li> <a href="index.php">Inicio</a></li>
                <li> <a href="foro.php">Foro</a></li>
                <?php if (isset($_SESSION['usuario'])) { ?>
                    <li><a href="cerrar_sesion.php">Cerrar Sesion</a></li>
                <?php } else { ?>
                    <li> <a href="registrarse.php">Registrarse</a></li>
                    <li> <a href="Login.php">Iniciar Sesion</a></li>
                <?php } ?>
            </ul>
      </nav>
  </header>
    <div class="container">
        <form action="registro.php" method="post" enctype="multipart/form-data">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>

            <label for="fechadenacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fechadenacimiento" name="fechadenacimiento" required><br>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required><br>

            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required><br>

            <label for="avatar">Foto De Perfil:</label>
            <input type="file" id="avatar" name="avatar" accept="image/*" ><br>

            <input type="submit" value="Registrarse">
        </form>
    </div>
    <footer>
        <p>&copy;weslytupapa</p>
    </footer>
</body>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    text-align: center;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 400px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

label {
    font-weight: bold;
}

input[type="submit"] {
      background-color: #333;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 5px;
      margin-top: 10px;
      cursor: pointer;
    }

input[type="submit"]:hover {
    background-color: #0056b3;
}
</style>
</html>
