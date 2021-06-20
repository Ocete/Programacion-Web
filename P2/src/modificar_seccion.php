<?php
  session_start();
  require 'utils.php';

  // Si el usuario no es admin lo devolvemos al inicio
  if ( empty($_SESSION['admin']) ) {
    back_to_index();
  }

  $campos = array('name');
  $section_id = $_POST['section_id'];
  unset($_POST['section_id']);

  $db = connect_to_db();
  $query = build_update_query('section' , $campos, $_POST, 'section_id', $section_id);
  compute_query($db, $query);
  disconnect_from_db($db);

  echo 'Sección modificada correctamente.';
  echo '<br><a href="section.php?id='.$section_id.'">Volver</a>';
?>
