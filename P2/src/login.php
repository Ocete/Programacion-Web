<?php
  session_start();
  require 'utils.php';

  // Nos conectamos a la BBDD
  $db = connect_to_db();

  // Buscamos el usuario en la BBDD
  $query = 'SELECT * FROM user WHERE username = "'.$_POST["username"].'";';
  $resultados = compute_query($db, $query);
  disconnect_from_db($db);

  foreach ( $resultados as $fila ) {
    if ( $fila["password"] == $_POST["password"] ) {

      $_SESSION['user'] = $fila["name"];
      $_SESSION['username'] = $fila["username"];

      if ($fila["admin"]) {
        $_SESSION['admin'] = "true";
      }

      back_to_index();
    }
  }

  echo 'Usuario o contraseña incorrecta.';
  echo '<br><a href="' . $index_url . '">Volver</a>';

?>
