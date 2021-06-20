<?php
  include_once 'utils.php';

  function print_code_for_login_validation() {
    echo '
      <script src="/~pw77553417/pe2/src/validate.js"></script>

      <script type="text/javascript" type="module">
        function submit_login_form(){
          var ids = ["username", "password"];
          var types = ["text", "text"];

          return validate(ids, types);
        }
      </script>
    ';
  }

  function print_header() {
    $path = '';
    if ( !empty($_SESSION['username']) ) {
      $db = connect_to_db();
      $query = 'SELECT profile_picture_path FROM user WHERE username = "'.$_SESSION['username'].'";';
      $path = compute_query($db, $query)->fetch()['profile_picture_path'];
    }
    
    echo '
    <header class="header_and_footer">
        <a href="/~pw77553417/pe2/">
          <img src="/~pw77553417/pe2/imgs/logo2.png" alt="Logo" id="logo"/>
        <a/>

        ';

        if ($path !== '') {
          echo '<img src="/~pw77553417/pe2/imgs/users/'.$path.'"
                  height="80px"/>';
        }

        echo '
        <aside id="header_form_container">';
            if ( !empty($_SESSION['user']) ) {
              echo '
                <a id="user_disaply">Usuario: '.$_SESSION['user'].'</a><br>
                <a class="blue-button" href="/~pw77553417/pe2/src/logout.php">Cerrar sesión</a>
                <a class="blue-button" href="/~pw77553417/pe2/src/modificar_usuario.php">Cambiar mi info</a>
              ';

              if ( !empty($_SESSION['admin']) ) {
                echo '
                  <br><a href="/~pw77553417/pe2/src/administracion.php">
                    Administración
                  </a>
                ';
              }
            } else {
              echo ' 
              <form method="post" onSubmit="return submit_login_form();" 
                  action="/~pw77553417/pe2/src/login.php" id="loginForm" >

                <label for="user">Usuario:   </label>
                <input type="text" name="username" id="username"/><br>

                <label for="password">Contraseña:   </label>
                <input type="password" name="password" id="password"/><br>

                <input type="submit" id="send_button"
                  class="blue-button submit_button" value="Enviar"/>

                <!--- Esto está dentro del formulario para poner
                      el boton y esto en la misma línea --->
                <a href="/~pw77553417/pe2/src/altausuario.php">
                  Registro de usuarios
                </a>
              </form> 
              ';
            }

      echo '
        </aside>
      </header>';
  }


  function print_nav_bar() {
    $result = get_all_sections();

    echo '<nav class="nav_section_button">';

    foreach ($result as $section) {
      echo '<a class="blue-button" href="/~pw77553417/pe2/src/section.php?id='.
        $section['section_id'].'">'.$section['name'].'</a>';
    }
     echo '</nav>';
  }

  function print_footer() {
    echo '
      <footer class="header_and_footer hide-mobile">
        <a class="clickable" href="/~pw77553417/pe2/src/contacto.php">Contacto</a> -
        <a class="clickable" href="/~pw77553417/pe2/como_se_hizo.pdf">Cómo se hizo</a>
      </footer>
    ';
  }

?>