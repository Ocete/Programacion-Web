<?php
  session_start();
  require 'utils.php';
  require 'utils_html.php';


  // Nos conectamos a la BBDD
  $db = connect_to_db();

  $not_found = true;
  if ( isset($_GET['id']) ) {
    $serie_id = $_GET['id'];

    // Creamos una consulta para añadir un nuevo item
    $query = 'SELECT * FROM serie where serie_id ="'.$serie_id.'";';
    $result = compute_query($db, $query);

    if ($result->rowCount() > 0) {
      $not_found = false;
      $serie = $result->fetch();
    
      $query = 'SELECT name FROM section where section_id ="'.$serie['section_id'].'";';
      $section_name = compute_query($db, $query)->fetch()['name'];
    }


    // Preparamos las secciones en caso de que el usuario sea un admin
    $query = "SELECT * FROM section";
      $result = compute_query($db, $query);

      // Construimos un array con las de las distintas secciones
      $sections = array();
      foreach ( $result as $row ) {
        array_push( $sections, array($row["section_id"], $row["name"]) );
      }

  }

  // Buscamos el siguiente id de serie y el anterior
  $prev_query = 'select * from serie where serie_id = '.
              '(select max(serie_id) from serie where serie_id < '.$serie_id.');';
  $next_query = 'select * from serie where serie_id = '.
              '(select min(serie_id) from serie where serie_id > '.$serie_id.');';
  $prev_id_result = compute_query($db, $prev_query)->fetch();
  $next_id_result = compute_query($db, $next_query)->fetch();

  $prev_id = -1;
  $next_id = -1;
  if ( !empty($prev_id_result) ) {
    $prev_id = $prev_id_result['serie_id'];
  }
  if ( !empty($next_id_result) ) {
    $next_id = $next_id_result['serie_id'];
  }


  disconnect_from_db($db);
?>

<!DOCTYPE HTML>
<html lang = "en">
  <head>
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Trirong">
    <title>Netflix</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/estilo.css" />
    <link rel="stylesheet" type="text/css" href="../css/item.css" />
  </head>

  <body>
    <?php print_header(); ?>

    <main>
      <?php print_nav_bar(); ?>

      <?php
        if ($not_found) {
          echo 'Serie no encontrada';
        } else if ( empty($_SESSION['admin']) ) {
          echo '
            <section class="item_container">
              <section class="info_container">
                <img src="../imgs/series/'.$serie['serie_picture_path'].'" class="movie_box_image"
                  alt="'.$serie['title'].'"/>

                <aside class="form_container">
                  <p class="label">Título: </p> '.$serie['title'].' <br>
                  <p class="label">Género: </p> '.$section_name.' <br>
                  <p class="label">Temporadas: </p> '.$serie['n_temps'].' <br>
                  <p class="label">Plataforma: </p> '.$serie['platform'].' <br>
                  <p class="label">Fecha de estreno: </p> '.$serie['premiere_date'].' <br>
                  <p class="label">Para mayores de 18: </p>';
                    if ( $serie['pegi_18'] ) echo 'Si';
                    else echo 'No';
                echo '</aside>
              </section>

              <h4>Descripción</h4>
              <p> '.$serie['description'].' </p>
            </section>
          ';
        } else {
            echo '
            <form class="item_container" action="modificar_item.php" method="post">
              <section class="">
                <img src="../imgs/series/'.$serie['serie_picture_path'].'" class="movie_box_image"
                  alt="'.$serie['title'].'"/><br><br>
                <label for="serie_picture_path" class="label">Logo de la serie:   </label><br>
                <label class="orange-button">
                  <input name="serie_picture_path" 
                        id="serie_picture_path" type="file"/>
                  Seleccionar imagen
                </label>

                <aside class="form_container">
                  <label class="label" for="text" class="label">Título:   </label>
                  <input type="text" name="title" id="title" value="'.$serie['title'].'"/><br>

                  <label class="label" for="section_id">Género:    </label>
                  <select name="section_id" id="section_id" value="'.$serie['section_id'].'">';
                    foreach ($sections as $row) {
                      echo '<option value="'.$row[0].'">'.$row[1].'</option>';
                    }
                    echo '
                  </select><br>

                  <label class="label" for="n_temps">Número de temporadas: </label>
                  <input type="number" name="n_temps" id="n_temps" value="'.$serie['n_temps'].'"/><br>

                  <label class="label" for="platform">Número de temporadas: </label>
                  <select name="platform" id="platform" value="'.$serie['platform'].'">';
                    foreach (array('Netflix', 'HBO', 'Amazon Prime') as $p) {
                      echo '<option value="'.$p.'">'.$p.'</option>';
                    }
                    echo '
                  </select><br>

                  <label class="label" for="premiere_date"> Fecha de estreno: </label>
                  <input type="date" name="premiere_date" id="premiere_date" value="'.$serie['premiere_date'].'"/><br>

                  <input type="hidden" id="serie_id" name="serie_id" value="'.$serie['serie_id'].'">
                </aside>

              </section>

              <h4>Descripción</h4>
              <textarea id="description" name="description" maxlength="1023"
                rows="5" cols="50" >'.$serie['description'].'</textarea><br>

              <input type="submit" id="send_button"
                class="orange-button submit_button" value="Guardar cambios"/><br>
            </form>

            <form class="item_container" action="eliminar_item.php" method="post">
              <input type="hidden" id="serie_id" name="serie_id" value="'.$serie['serie_id'].'">

              <input type="submit" id="send_button"
                class="orange-button submit_button" value="Eliminar serie"/>
            </form>
          ';
        }

      ?>

      <nav class="items_nav">
        <?php 
          if ($prev_id !== -1) {
            echo '
            <a class="item_selector" href="item.php?id='.$prev_id.'" >
              Anterior
            </a>
            ';
          }
          if ($next_id !== -1) {
            echo '
            <a class="item_selector" href="item.php?id='.$next_id.'" >
              Siguiente
            </a>
            ';
          }
        ?>
        <br><br>
      </nav>
    </main>
    
    <?php print_footer(); ?>
  </body>
</html>
