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

  foreach ( $campos as $campo ) {
    if ( isset( $_POST[$campo] ) ) {
      echo 'Campo: '.$campo.'. Valor: '.$_POST[$campo].'.';
    } else {
      echo 'Campo: '.$campo.' - no se introdujo';
    }
    echo '<br>'
  }
?>
