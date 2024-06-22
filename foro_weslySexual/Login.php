<?php
session_start();
if (isset($_SESSION["usuario"])) {
  header('Location: foro.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="header.css">
  </head>
  <body>
    <header>
      <h1>Iniciar Sesión</h1>
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

    <section id="login">
      <form method="post" id="login-form" action="usuarios.php">
        <label for="usuario">correo:</label>
        <input type="text" id="usuario" name="usuario" required /><br />

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required /><br />

        <input type="submit" value="Iniciar Sesión" />
      </form>

      <div id="logout">
        <p>
          Bienvenido, <span id="user-display"></span> ( <a href="cerrar_sesion.php" id="cerrar-sesion" >Cerrar Sesión</a>)
        </p>
      </div>
    </section>

    <footer>
        <p>&copy;weslytupapa</p>
    </footer>
    <script>
        // JavaScript para cambiar el color de fondo de forma interactiva
        const body = document.body;
        let hue = 200; // Valor inicial del tono azul

        function changeBackgroundColor() {
            hue = (hue + 10) % 360;
            const color = `hsl(${hue}, 70%, 80%)`;
            body.style.backgroundColor = color;

            // Puedes ajustar la saturación y la luminosidad según tus preferencias
        }

        setInterval(changeBackgroundColor, 3000); // Cambia el color cada 3 segundos (puedes ajustar el intervalo)
    </script>
  </body>

  <style>
     body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        transition: background-color 0.5s; /* Agregamos una transición para suavizar los cambios de color */
    }

    header {
      background-color: #2c3e50;
      color: #fff;
      padding: 10px;
      text-align: center;
    }

    section {
      margin: 20px;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
    }

    form {
      display: flex;
      flex-direction: column;
      max-width: 300px;
      margin: 0 auto;
    }

    label {
      margin-top: 10px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
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

    #logout {
      text-align: center;
      margin-top: 20px;
    }

    #cerrar-sesion {
      color: #333;
      text-decoration: none;
      cursor: pointer;
    }

    #cerrar-sesion:hover {
      text-decoration: underline;
    }

    footer {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 10px;
      position: fixed;
      width: 100%;
      bottom: 0;
    }
    input[type="submit"]:hover {
    background-color: #0056b3;
}
  </style>
</html>
