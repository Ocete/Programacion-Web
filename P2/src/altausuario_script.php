<?php
  session_start();
  require 'utils.php';

  $campos = array('username',
                  'name',
                  'password',
                  'password2',
                  'email',
                  'phone',
                  'profile_picture_path');

  $campos_requeridos_vacios = array();
  foreach ( $campos as $campo ) {
    if ( array_key_exists( $campo, $_POST ) and $_POST[$campo] !== '' ) {
      // echo 'Campo: '.$campo.'. Valor: '.$_POST[$campo].'.<br>';
    } else {
      // echo 'Campo: '.$campo.' -> no se introdujo<br>';
      array_push($campos_requeridos_vacios, $campo);
    }
  }

  // Comprobamos los campos
  if ( empty($campos_requeridos_vacios) ) {
    // echo 'Todos los campos han sido rellenados!';
  } else {
    echo 'Los siguientes campos no han sido rellenados correctamente:';
    echo '<br>';
    foreach ( $campos_requeridos_vacios as $campo ) {
      echo $campo.'<br>';
    }
    exit();
  }

  // Comprobamos si las contraseñas coinciden
  if ( $_POST['password'] !== $_POST['password2']) {
    echo 'Las contraseñas no coinciden!';
    exit();
  }

  // Eliminamos el campo 'password2' del array ya que no será
  // necesario más adelante.
  unset($campos[3]);

  // Nos conectamos a la BBDD
  $db = connect_to_db();

  // Realizamos una consulta a la BBDD para confirmar que no hay ningún usuario
  // con ese username
  $query1 = "SELECT username FROM user";
  $resultados = compute_query($db, $query1);

  foreach ( $resultados as $fila ) {
    if ($fila["username"] == $_POST["username"]) {
      echo "Nombre de usuario ya existente!";
      echo exit();
    }
  }

  // Creamos una consulta para añadir un nuevo usuario
  $query2 = build_insert_query('user' , $campos, $_POST);
  compute_query($db, $query2);

  // Actualizamos la sesión
  $_SESSION['user'] = $_POST["name"];
  $_SESSION['username'] = $_POST["username"];

  echo 'Usuario dado de alta correctamente.';
  echo '<br><a href="' . $index_url . '">Volver</a>';
  disconnect_from_db($db);
?>
