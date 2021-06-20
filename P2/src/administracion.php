<?php
  session_start();
  require 'utils.php';
  require 'utils_html.php';
  
  if ( empty($_SESSION['admin']) ) {
    back_to_index();
  }
?>


<!DOCTYPE HTML>
<html lang = "en">
  <head>
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Trirong">
    <title>Netflix</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/estilo.css" />
    <link rel="stylesheet" type="text/css" href="../css/administracion.css" />
  </head>

  <body>
    <?php print_header(); ?>

    <main>
      <?php print_nav_bar(); ?>

      <h2>Administración</h2>

      <section class="admin_container">

        <a class="orange-button" href="altaitem.php"> Alta de items </a>
        <a class="orange-button" href="altaseccion.php"> Alta de secciones </a>

      </section>
    </main>
    
    <?php print_footer(); ?>
  </body>
</html>
