<?php
session_start();
if (isset($_SESSION["usuario"])) {
  $usuarioActivo = $_SESSION["usuario"];
  $id_sesion = $_SESSION['id_usuario'];
}
try {
  require 'conexion.php';

  $consulta_preguntas = $conexion->prepare("SELECT preguntas.*, usuarios.nombre, usuarios.avatar FROM preguntas 
                                            JOIN usuarios ON preguntas.ID_usuario = usuarios.id 
                                            ORDER BY preguntas.fecha DESC");
  $consulta_preguntas->execute();
  $preguntas = $consulta_preguntas->fetchAll(PDO::FETCH_ASSOC);

  $conexion = null;
} catch (PDOException $e) {
  die("Error en la base de datos: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Foro</title>
  <link rel="stylesheet" href="header.css">

</head>

<body>

  <header>
    <h1>Foro Web</h1>
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

  <section id="posts-section">
    <?php if ($preguntas) {
      foreach ($preguntas as $pregunta) { ?>
        <div class="poster">
          <div id="publicacion">
            <div id="usuario-info">
              <img
                src="<?php echo (isset($pregunta["avatar"])) ? $pregunta["avatar"] : 'https://png.pngtree.com/png-vector/20190710/ourlarge/pngtree-user-vector-avatar-png-image_1541962.jpg'; ?>"
                alt="Foto de perfil">
              <h2>
                <?php echo $pregunta["nombre"] ?>
              </h2>
            </div>

            <div id="publicacion-titulo">
              <h3>
                <?php echo $pregunta["titulo"] ?>
              </h3>
            </div>

            <div id="publicacion-contenido">
              <p>
                <?php echo $pregunta["contenido"] ?>
              </p>
              <?php if (isset($pregunta["imagen_pregunta"])) { ?>
                <img src="<?php echo $pregunta["imagen_pregunta"]; ?>" alt="Imagen de la publicación">
              <?php } ?>
            </div>
          </div>
          <div id="nuevo-comentario">
            <?php if (isset($_SESSION['usuario'])) { ?>
              <h3>Añadir Comentario</h3>
              <form action="procesar_comentario.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id-pregunta" value="<?php echo $pregunta['ID']; ?>">
                <textarea id="comentario-contenido" name="comentario-contenido" rows="4" cols="50" required></textarea><br>

                <input type="submit" value="Publicar Comentario">
              </form>
            <?php } else { ?>
              <p>Registrate para que puedas comentar</p>
            <?php } ?>
          </div>

          <p>Comentarios</p>
          <?php
          try {
            require 'conexion.php';

            $consulta_respuestas = $conexion->prepare("SELECT respuestas.*, usuarios.nombre, usuarios.avatar FROM respuestas
                    JOIN usuarios ON respuestas.ID_usuario = usuarios.id
                    WHERE respuestas.ID_preguntas = :id
                    ORDER BY respuestas.fecha DESC");
            $consulta_respuestas->bindParam(":id", $pregunta['ID']);
            $consulta_respuestas->execute();
            $respuestas = $consulta_respuestas->fetchAll(PDO::FETCH_ASSOC);

            $conexion = null;

          } catch (PDOException $e) {
            die("Error en la base de datos: " . $e->getMessage());
          }
          if ($respuestas) {
            foreach ($respuestas as $respuesta) {
              ?>
              <div class="comentario">
                <div class="comentario-usuario-info">
                  <img
                    src="<?php echo (isset($respuesta["avatar"])) ? $respuesta["avatar"] : 'https://png.pngtree.com/png-vector/20190710/ourlarge/pngtree-user-vector-avatar-png-image_1541962.jpg'; ?>"
                    alt="Foto de perfil del Comentador 1">
                  <h4>
                    <?php echo $respuesta["nombre"]; ?>
                  </h4>
                </div>

                <p>
                  <?php echo $respuesta["fecha"]; ?>
                </p>

                <p>
                  <?php echo $respuesta["contenido"]; ?>
                </p>

              </div>
              <?php
            }
          } else { ?>
            <div class="respuestas">
              <p>No hay Comentarios...</p>
            </div>
            <?php
          } ?>
        </div>

      <?php }
    } ?>
  </section>

  <section id="form-section">
    <?php if (isset($_SESSION['usuario'])) { ?>
      <h2>Publicar nuevo post</h2>
      <form method="post" id="post-form" action="registrar_pregunta.php" enctype="multipart/form-data"
        class="question-form">
        <label for="post-user">Publicacion:</label><br>
        <input type="text" id="post-user" name="post-title" required><br>

        <label for="post-content">Contenido:</label><br>
        <textarea id="post-content" name="post-content" rows="4" cols="50" required></textarea><br>

        <label for="post-image">Imagen (opcional):</label><br>
        <input type="file" id="post-image" name="post-image" accept="image/*"><br><br>

        <input type="submit" value="Publicar Post" class="btn">
      </form>
    <?php } else { ?>
      <p>Registrate para que puedas enviar preguntas</p>
    <?php } ?>
  </section>
  <footer>
    <p>&copy;tupapáwesly 2023 Foro de Posteo</p>
  </footer>
</body>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
  }

  header {
    background-color: #333;
    color: white;
    padding: 10px;
    text-align: center;
  }

  section {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
  }

  .poster {
    background-color: rgba(0, 0, 0, 0.2);
    margin: 40px auto;
    margin-bottom: 20px;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .post {
    margin-bottom: 20px;
    padding: 15px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
  }

  .comment {
    margin-top: 10px;
    padding: 10px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 4px;
  }

  .btn {
    padding: 10px;
    background-color: #333;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    display: inline-block;
  }

  #publicacion {
    border: 1px solid #ccc;
    background-color: cadetblue;
    padding: 10px;
    margin-bottom: 20px;
  }

  #usuario-info {
    display: flex;
    align-items: center;
  }

  #usuario-info img {
    width: 50px;

    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
  }

  #publicacion-titulo {
    font-size: 1.5em;
    margin-bottom: 10px;
  }

  #publicacion-contenido img {
    
    max-width: 100%;
    height: auto;
    margin-top: 10px;
  }

  .comentario {
    border: 1px solid #ccc;
    background-color: burlywood;
    padding: 10px;
    margin-bottom: 10px;
  }
  textarea{
    width: 100%;
    height:20px;
  }

  .comentario-usuario-info {
    display: flex;
    align-items: center;
  }

  .comentario-usuario-info img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
  }

  .comentario-contenido img {
    max-width: 100%;
    height: auto;
    margin-top: 10px;
  }
  #post-user{
    width:100%;
    height:20px;
  }
  #post-content{
    width:100%;
    height:100px;
  }

</style>

</html>