<?php
  session_start();
  require 'utils.php';

  // Si el usuario no es admin lo devolvemos al inicio
  if ( empty($_SESSION['admin']) ) {
    back_to_index();
  }

  $campos = array('title',
                  'section_id',
                  'n_temps',
                  'platform',
                  'premiere_date',
                  'description',
                  'serie_picture_path');

  $serie_id = $_POST['serie_id'];
  unset($_POST['serie_id']);

  foreach ($campos as $key => $value) {
    if ( !isset($_POST[$value]) or $_POST[$value] === "") {
      unset($campos[$key]);
    }
  }

  $db = connect_to_db();
  $query = build_update_query('serie' , $campos, $_POST, 'serie_id', $serie_id);
  compute_query($db, $query);
  disconnect_from_db($db);

  echo 'Item modificado correctamente.';
  echo '<br><a href="item.php?id='.$serie_id.'">Volver</a>';
?>
