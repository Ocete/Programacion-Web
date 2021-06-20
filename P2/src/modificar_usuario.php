<?php
  session_start();
  require 'utils.php';
  require 'utils_html.php';

  // Si el usuario no está loggeado lo devolvemos al inicio
  if ( empty($_SESSION['user']) ) {
    back_to_index();
  }

  // Obtenemos el usuario a partir de su username en sesión
  $db = connect_to_db();
  $query = 'SELECT * FROM user WHERE username = "'.$_SESSION['username'].'";';
  $user = compute_query($db, $query)->fetch();
  disconnect_from_db($db);
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
  </head>

  <body>
    <?php print_header(); ?>

    <main>
      <?php print_nav_bar(); ?>

      <h2>Modificación de datos de usuario</h2>

        <form class="form_container" action="modificar_usuario_script.php" method="POST">

          <aside class="file_selector">
            <label for="profile_picture_path">Imagen de usuario:   </label><br>
            <input name="profile_picture_path"
                   id="profile_picture_path" type="file"
                   value="Seleccionar imagen" />
          </aside>

          <aside class="smaller_form_container">
            <label for="text">Nombre de usuario:   </label>
            <input type="text" name="username" id="username" value=<?php echo '"'.$user['username'].'"' ?>/><br>

            <label for="text">Nombre:   </label>
            <input type="text" name="name" id="name" value=<?php echo '"'.$user['name'].'"' ?>/><br>

            <label for="password">Cambiar contraseña:    </label>
            <input type="password" name="password" id="password"/><br>

            <label for="email">Correo: </label>
            <input type="email" name="email" id="email" value=<?php echo '"'.$user['email'].'"' ?>/><br>

            <label for="tel">Teléfono: </label>
            <input type="tel" name="phone" id="phone" value=<?php echo '"'.$user['phone'].'"' ?>/><br><br>

            <label for="password">Verifica que eres tú con tu contraseña:    </label>
            <input type="password" name="old_password" id="old_password" /><br>

            <input type="submit" id="send_button"
              class="orange-button submit_button" value="Actualizar datos"/>

          </aside>
        </form>
      </main>

    <?php print_footer(); ?>
  </body>
</html>
