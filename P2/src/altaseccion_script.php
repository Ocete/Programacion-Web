<?php
  session_start();
  require 'utils.php';

  // Nos conectamos a la BBDD
  $db = connect_to_db();

  // Realizamos una consulta a la BBDD para confirmar que no hay ninguna sección
  // con ese nombre
  $query1 = "SELECT name FROM section";
  $resultados = compute_query($db, $query1);

  foreach ( $resultados as $fila ) {
    if ($fila["name"] == $_POST["name"]) {
      echo "Nombre de sección ya existente!";
      echo exit();
    }
  }

  // Creamos una consulta para añadir la nueva sección
  $query2 = build_insert_query('section' , array('name'), $_POST);
  compute_query($db, $query2);
  disconnect_from_db($db);

  echo 'Sección dada de alta correctamente.';
  echo '<br><a href="' . $index_url . '">Volver</a>';
?>
