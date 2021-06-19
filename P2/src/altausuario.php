<?php
  $campos = array('username',
                  'name',
                  'password',
                  'password2',
                  'email',
                  'phone',
                  'image');


  $campos_requeridos_vacios = array();

  foreach ( $campos as $campo ) {
    if ( array_key_exists( $campo, $_POST ) and $_POST[$campo] !== '' ) {
      // echo 'Campo: '.$campo.'. Valor: '.$_POST[$campo].'.';
    } else {
      echo 'Campo: '.$campo.' -> no se introdujo';
      array_push($campos_requeridos_vacios, $campo);
    }
    echo '<br>';
  }

  // Comprobamos los campos

  if ( empty($campos_requeridos_vacios) ) {
    echo 'Todos los campos han sido rellenados!';
  } else {
    echo 'Los siguientes campos no han sido rellenados correctamente:';
    echo '<br>';
    foreach ( $campos_requeridos_vacios as $campo ) {
      echo $campo.'<br>';
    }
    exit();
  }

  echo '<br><br>';

  $dsn = "mysql:host=betatun.ugr.es;dbname=db77553417_pw2021";
  $usuario= "pw77553417";
  $password= "77553417";

  try {
    $conexion = new PDO( $dsn, $usuario, $password );
    //$conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  } catch ( PDOException $e ) {
    echo "Conexión fallida: " . $e->getMessage();
    exit();
  }

  $consultaSQL = "SELECT username FROM user";
  $resultados = $conexion->query( $consultaSQL );
  try {
    $conexion->query( $consultaSQL );
  } catch ( PDOException $e ) {
    echo "Consulta fallida: " . $e->getMessage();
    exit();
  }

  foreach ( $resultados as $fila ) {
    if ($fila["username"] == $_POST["username"]) {
      echo "Nombre de usuario ya existente!";
      echo exit();
    }
  }

  echo "<br>fin!<br>";

?>
