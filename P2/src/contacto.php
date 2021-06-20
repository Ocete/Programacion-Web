<?php
  session_start();
  require 'utils_html.php';
?>

<!DOCTYPE HTML>
<html lang = "en">
  <head>
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Trirong">
    <title>Netflix</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/estilo.css" />
    <link rel="stylesheet" type="text/css" href="../css/contacto.css" />
  </head>

  <body>
    <?php print_header(); ?>

    <main>
      <?php print_nav_bar(); ?>

      <h2>Contacto</h2>

      <section class="contact_container">
        <a class="bold"> Nombre: </a> José Antonio <br>
        <a class="orange-button" href="mailto:correofalso@ugr.es"> Correo </a>
      </section>
    </main>

    <?php print_footer(); ?>
  </body>
</html>
