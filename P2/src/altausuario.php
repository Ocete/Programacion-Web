<?php
  session_start();
  require 'utils.php';
  require 'utils_html.php';

  // Si el usuario ya está loggeado lo devolvemos al inicio
  if ( !empty($_SESSION['user']) ) {
    back_to_index();
  }
?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Trirong">
    <title>Netflix</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/estilo.css" />
    <link rel="stylesheet" type="text/css" href="../css/altaitem.css" />

    <?php print_code_for_login_validation() ?>

    <script type="text/javascript">

      function on_submit_signup() {
        var ids = ["username_alta", "name", "password_alta", "password2",
                    "email", "phone", "profile_picture_path"];

        var types = ["text", "text", "text", "text",
                    "email", "phone", "path"];

        var validation = validate(ids, types);
        if (validation) {
          validation = document.getElementById('password_alta').value ===
                        document.getElementById('password2').value;

          if (!validation)
            alert('Las contraseñas deben coincidir!');
        }

        return validation;
      }

    </script>
  </head>

  <body>
    <?php print_header(); ?>

    <main>
      <?php print_nav_bar(); ?>

      <h2>Alta de usuario</h2>

        <form class="form_container" onSubmit="return on_submit_signup();"
            action="altausuario_script.php" method="POST">

          <aside class="file_selector">
            <label for="profile_picture_path">Imagen de usuario:   </label><br>
            <input name="profile_picture_path"
                   id="profile_picture_path" type="file"
                   value="Seleccionar imagen" />
          </aside>

          <aside class="smaller_form_container">
            <label for="text">Nombre de usuario:   </label>
            <input type="text" name="username" id="username_alta"/><br>

            <label for="text">Nombre:   </label>
            <input type="text" name="name" id="name"/><br>

            <label for="password">Contraseña:    </label>
            <input type="password" name="password" id="password_alta"/><br>

            <label for="confirm_password">Confirma Contraseña:    </label>
            <input type="password" name="password2" id="password2"/><br>

            <label for="email">Correo: </label>
            <input type="email" name="email" id="email"/><br>

            <label for="tel">Teléfono: </label>
            <input type="tel" name="phone" id="phone"/><br>

            <input type="submit" id="send_button2"
              class="orange-button submit_button" value="Dar de alta"/>
          </aside>
        </form>
      </main>

    <?php print_footer(); ?>
  </body>
</html>
