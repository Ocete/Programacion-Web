<?php
  session_start();
  require 'utils.php';

  // Si el usuario no es admin lo devolvemos al inicio
  if ( empty($_SESSION['admin']) ) {
    back_to_index();
  }

  $serie_id = $_POST['serie_id'];
  unset($_POST['serie_id']);

  $db = connect_to_db();
  $query = build_delete_query('serie', 'serie_id', $serie_id);
  compute_query($db, $query);
  disconnect_from_db($db);

  echo 'Item eliminado correctamente.';
  echo '<br><a href="'.$index_url.'">Volver</a>';
?>
