<?php
  session_start();
  require 'utils.php';

  $campos = array('title',
                  'section_id',
                  'n_temps',
                  'platform',
                  'premiere_date',
                  'pegi_18',
                  'description',
                  'serie_picture_path');

  if ( !isset($_POST['pegi_18']) ) {
    $_POST['pegi_18'] = '0';
  }

  // Nos conectamos a la BBDD
  $db = connect_to_db();

  // Creamos una consulta para añadir un nuevo item
  $query = build_insert_query('serie' , $campos, $_POST);
  compute_query($db, $query);

  echo 'Item dado de alta correctamente.';
  echo '<br><a href="altaitem.php">Volver</a>';
  disconnect_from_db($db);
?>
