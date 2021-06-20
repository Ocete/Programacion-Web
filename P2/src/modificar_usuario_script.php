<?php
  session_start();
  require 'utils.php';

  $campos = array('username',
                  'name',
                  'password',
                  'email',
                  'phone',
                  'profile_picture_path');

  // Verificamos si la contraseña encaja
  $db = connect_to_db();
  $query = 'SELECT * FROM user WHERE username = "'.$_POST['username'].'";';
  $user = compute_query($db, $query)->fetch();

  if ( $user['password'] !== $_POST['old_password'] ) {
    echo 'Contraseña incorrecta.';
  } else {

    // Eliminamos los campos vacíos para no ponerlos en blanco en la base de datos
    foreach ($campos as $key => $value) {
      if ( !isset($_POST[$value]) or $_POST[$value] === "") {
        unset($campos[$key]);
      }
    }
    unset($_POST['old_password']);

    $query = build_update_query('user' , $campos, $_POST, 'username', $_POST['username']);
    compute_query($db, $query);
    disconnect_from_db($db);

    $_SESSION['user'] = $_POST['name'];
    $_SESSION['username'] = $_POST['username'];

    echo 'Item modificado correctamente.';
  }
  
  echo '<br><a href="modificar_usuario.php">Volver</a>';
?>
