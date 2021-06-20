<?php
  session_start();
  require 'utils.php';
  require 'utils_html.php';

  // Si el usuario no es admin lo devolvemos al inicio
  if ( empty($_SESSION['admin']) ) {
    back_to_index();
  }

  $db = connect_to_db();
  $query = "SELECT * FROM section";
  $result = compute_query($db, $query);
  disconnect_from_db($db);

  // Construimos un array con los nombres de las distintas secciones
  $sections = array();
  foreach ( $result as $row ) {
    array_push( $sections, array($row["section_id"], $row["name"]) );
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
        var ids = ["title", "section_id", "n_temps", "premiere_date",
                    "description", "serie_picture_path"];

        var types = ["text", "number", "number", "date", "big-text", "path"];

        return validate(ids, types);
      }

    </script>
  </head>

  
  <body>
    <?php print_header(); ?>

    <main>
      <?php print_nav_bar(); ?>

      <h2>Añadir serie</h2>

        <form class="form_container" onSubmit="return on_submit_signup();"
            action="altaitem_script.php" method="post">

          <aside class="file_selector">
            <label for="serie_picture_path">Logo de la serie:   </label><br>
            <label class="orange-button">
              <input name="serie_picture_path" 
                    id="serie_picture_path" type="file" />
              Seleccionar imagen
            </label>
          </aside>

          <aside class="smaller_form_container">
            <label for="text">Título:   </label>
            <input type="text" name="title" id="title" /><br>

            <label for="section_id">Género:    </label>
            <select name="section_id" id="section_id">
              <?php
                foreach ($sections as $row) {
                  echo '<option value="'.$row[0].'">'.$row[1].'</option>';
                }
              ?>
            </select><br>

            <label for="n_temps">Número de temporadas: </label>
            <input type="number" name="n_temps" id="n_temps" /><br>

            <label for="platform">Plataforma:      </label>
            <input type="radio" id="platform1" name="platform"
              value="Netflix" checked/>
            <label for="platform1">Netflix</label>
            <input type="radio" id="platform2" name="platform"
              value="HBO" />
            <label for="platform2">HBO</label>
            <input type="radio" id="platform3" name="platform"
              value="Amazon Prime" />
            <label for="platform3">Amazon Prime</label><br>

            <label for="premiere_date">Fecha de estreno: </label>
            <input type="date" name="premiere_date" id="premiere_date" /><br>

            <label for="pegi_18">Para mayores de 18: </label>
            <input type="checkbox" id="pegi_18" name="pegi_18" value="1" /><br>

            <label for="description">Descripción:</label><br>
            <textarea id="description" name="description"
                rows="5" cols="50" maxlength="1023" ></textarea><br>

            <input type="submit" id="send_button"
              class="orange-button submit_button" value="Registrar serie"/>
          </aside>
        <form>
    </main>

    <?php print_footer(); ?>
  </body>
</html>
