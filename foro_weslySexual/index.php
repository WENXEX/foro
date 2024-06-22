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
    <title>Foro de Posteo</title>
    <link rel="stylesheet" href="header.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #3498db, #2c3e50); /* Cambia estos colores según tus preferencias */
            color: #2c3e50; /* Color del texto */
        }

        header {
            background-color: #2c3e50; /* Color de fondo del encabezado */
            padding: 10px;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }

        nav ul li {
            display: inline;
            margin-right: 10px;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff; /* Color del enlace en el encabezado */
        }

        section {
            margin: 20px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Fondo semi-transparente blanco */
            border-radius: 10px;
        }

        .icon-row {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap; /* Permite que las imágenes se envuelvan si no hay suficiente espacio */
        }

        .icon-row img {
            width: 75px;
            height: 75px;
            margin: 10px; /* Ajusta el espaciado entre las imágenes */
            border-radius: 50%; /* Da a las imágenes una forma circular */
        }
    </style>
</head>

<body>
    <header>
        <h1>Bienvenido al Foro de Posteo</h1>
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

    <section id="usuarios">
        <h2>Usuarios</h2>
        <div class="icon-row">
            <img src="iconosenlinea/unnamed.jpg" alt="Icono 1">
            <img src="iconosenlinea/2.png" alt="Icono 2">
            <img src="iconosenlinea/21.jpg" alt="Icono 3">
            <img src="iconosenlinea/image.jpg" alt="Icono 4">
            <img src="iconosenlinea/1.jpg" alt="Icono 5">
            <img src="iconosenlinea/unnamed (1).jpg" alt="Icono 6">
            <img src="iconosenlinea/8.jpg" alt="Icono 7">
            <img src="iconosenlinea/OIP.jpg" alt="Icono 8">
            <img src="iconosenlinea/OIP (1).jpg" alt="Icono 9">
            <img src="iconosenlinea/OIP (2).jpg" alt="Icono 10">
            <img src="iconosenlinea/OIP (3).jpg" alt="Icono 11">
            <img src="iconosenlinea/OIP (4).jpg" alt="Icono 12">
        </div>
    </section>

    <section id="foro">
    <h2>Foro de Posteo</h2>
    <div class="conversacion">
    <div class="mensaje usuario">
            <img src="iconosenlinea/image.jpg" alt="Icono 4">
            <p><strong>el terror de las gorditas:</strong> Estamos discutiendo sobre el foro. ¿Alguien tiene alguna sugerencia?</p>
        </div>
 <div class="mensaje usuario">
            <img src="iconosenlinea/21.jpg" alt="Icono 3">
            <p><strong>mataviejitas:</strong> ¡Hola chicos! ¿De qué están hablando?</p>
        </div>
<div class="mensaje usuario">
            <img src="iconosenlinea/2.png" alt="Icono 2">
            <p><strong>el renegull:</strong> ¡Hola aftmonkey! Todo bien, gracias. ¿Y tú?</p>
        </div>
<div class="mensaje usuario">
            <img src="iconosenlinea/unnamed.jpg" alt="Icono 1">
            <p><strong>aftmonkey:</strong> Hola, ¿cómo están todos?</p>
        </div>
    </div>
</section>

</body>
<style>
     section {
        margin: 20px;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
    }

    .icon-row {
        display: flex;
        justify-content: center; /* Centra horizontalmente las imágenes */
        align-items: center; /* Centra verticalmente las imágenes */
    }

    .icon-row img {
        width: 75px; /* Ajusta el tamaño según tus necesidades */
        height: 75px;
        margin: 0 10px; /* Ajusta el espaciado horizontal entre las imágenes */
    }

    .conversacion {
    margin-top: 20px;
    display: flex;
    flex-direction: column-reverse; /* Muestra los mensajes de arriba a abajo */
}

.mensaje {
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 5px;
    background-color: #e6f7ff; /* Fondo del mensaje */
}

.mensaje.usuario {
    align-self: flex-start; /* Alinea los mensajes de los usuarios a la izquierda */
}

.mensaje img {
    width: 50px;
    height: 50px;
    border-radius: 50%; /* Da a las imágenes una forma circular */
    margin-right: 10px;
}

</style>

</html>