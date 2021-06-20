<?php
  session_start();
  require 'utils.php';

  // Si el usuario no es admin lo devolvemos al inicio
  if ( empty($_SESSION['admin']) ) {
    back_to_index();
  }

  $section_id = $_POST['section_id'];
  $db = connect_to_db();

  // Obtenemos todas las series de la sección
  $query = 'SELECT serie_id FROM serie WHERE section_id = "'.$section_id.'";';
  $result = compute_query($db, $query);

  // Eliminamos las series una por una
  foreach ($result as $serie_id) {
    $query = build_delete_query('serie', 'serie_id', $serie_id['serie_id']);
    compute_query($db, $query);
  }

  // Finalmente eliminamos la sección y desconectamos
  $query = build_delete_query('section', 'section_id', $section_id);
  compute_query($db, $query);
  disconnect_from_db($db);

  echo 'Item eliminado correctamente.';
  echo '<br><a href="'.$index_url.'">Volver</a>';
?>
