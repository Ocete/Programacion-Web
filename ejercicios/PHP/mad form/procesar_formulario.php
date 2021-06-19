<?php
  $campos = array('nombre',
                  'apellido',
                  'password1',
                  'password2',
                  'gustaChocolate',
                  'noGustaChocolate',
                  'rangoEdad',
                  'deporte',
                  'comentarios');

  $campos_requeridos = array('nombre',
                  'apellido',
                  'password1',
                  'password2');

  $campos_requeridos_vacios = array();
  $chocolate_rellenado = TRUE;

  foreach ( $campos as $campo ) {
    if ( isset( $_POST[$campo] ) ) {
      echo 'Campo: '.$campo.'. Valor: '.$_POST[$campo].'.';
    } else {
      echo 'Campo: '.$campo.' - no se introdujo';
    }
    echo '<br>';
  }

  echo '<br><br>';

  foreach ( $campos_requeridos as $campo ) {
    if ( !(isset( $_POST[$campo])) ) {
      $campos_requeridos_vacios[] = $campo;
    }
    if ( !(isset( $_POST['gustaChocolate'])) &&
         !(isset( $_POST['noGustaChocolate']))) {
      $chocolate_rellenado = FALSE;
    }
  }

  if ( empty(  $campos_requeridos_vacios) && $chocolate_rellenado ) {
    echo 'Todos los campos han sido rellenados correctamente!';
  } else {
    echo 'Los siguientes campos no han sido rellenados correctamente:';
    echo '<br>';
    foreach ( $campos_requeridos_vacios as $campo ) {
      echo $campo.'<br>';
    }
    if (!$chocolate_rellenado) {
      echo '¿Te gusta el chocolate?';
    }
  }

?>
