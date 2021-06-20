<?php
  session_start();
  require 'utils.php';
  require 'utils_html.php';

  // Si el usuario no es admin lo devolvemos al inicio
  if ( empty($_SESSION['admin']) ) {
    back_to_index();
  }
?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Trirong">
    <title>Netflix</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/estilo.css" />
    <link rel="stylesheet" type="text/css" href="../css/altaitem.css" />
  </head>

  <body>
    <?php print_header(); ?>

    <main>
      <?php print_nav_bar(); ?>

      <h2>Alta de secciones</h2>

        <form class="form_container" action="altaseccion_script.php" method="POST">
          <label for="text">Nombre de la sección:   </label>
          <input type="text" name="name" id="name"/><br>
        </form>
    </main>

    <?php print_footer(); ?>
  </body>
</html>
