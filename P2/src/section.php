<?php
  session_start();
  require 'utils.php';
  require 'utils_html.php';

  function previous_page($id, $page) {
    return 'section.php?id='.$id.'&page='.($page-1);
  }

  function next_page($id, $page) {
    return 'section.php?id='.$id.'&page='.($page+1);
  }

  function should_display_prev_button($page) {
    return $page > 0;
  }

  function should_display_next_button($id, $page) {
    $db = connect_to_db();
    $offset = ($page+1)*9;
    $query = 'SELECT serie_id FROM serie WHERE section_id ="'.$id.
        '" LIMIT '.$offset.',9;';
    $result = compute_query($db, $query)->fetchAll();
    disconnect_from_db($db);
    return count($result) > 0;
  }

  $not_found = true;
  if ( isset($_GET['id']) ) {
    $section_id = $_GET['id'];

    // Nos conectamos a la BBDD
    $db = connect_to_db();

    $query = 'SELECT * FROM section WHERE section_id ="'.$section_id.'";';
    $result = compute_query($db, $query);

    // Si la sección se encuentra en nuestra base de datos, la marcamos
    // como encontrada y obtenemos las correspondientes series
    if ($result->rowCount() > 0) {
      $not_found = false;
      $section_name = $result->fetch()['name'];

      $page = 0;
      if ( isset($_GET['page']) ) {
        // Haría falta revisar que esto es un entero mayor que 0
        $page = $_GET['page'];
      }
      $offset = 9*$page;

      // Creamos una consulta para añadir un nuevo item
      $query = 'SELECT * FROM serie WHERE section_id ="'.$section_id.'" LIMIT '.$offset.',9;';
      $series = compute_query($db, $query);
    }

    // Siempre cerramos la base de datos al final
    disconnect_from_db($db);
  }
?>

<!DOCTYPE HTML>
<html lang = "en">
  <head>
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Trirong">
    <title>Netflix</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="../css/estilo.css" />
    <link rel="stylesheet" type="text/css" href="../css/seccion.css" />
  </head>

  <body>
    <?php print_header(); ?>

    <main>
      <?php print_nav_bar(); ?>

      <?php
        if ($not_found) {
          echo 'No se ha encontrado la sección buscada';
        } else {
          if ( empty($_SESSION['admin']) ) {
            echo '<h2> '.$section_name.' </h2>';
          } else {
            echo'
              <form action="modificar_seccion.php" method="post">
                <input type="text" name="name" id="name" value="'.$section_name.'"/><br>
                <input type="hidden" id="section_id" name="section_id" value="'.
                    $section_id.'">

                <input type="submit" id="send_button"
                  class="orange-button submit_button" value="Actualizar nombre"/>
              </form>

              <form action="eliminar_seccion.php" method="post">
                <input type="hidden" id="section_id" name="section_id" value="'.
                    $section_id.'">
                <input type="submit" id="send_button"
                  class="orange-button submit_button" value="Eliminar sección"/>
              </form>
            ';
          }
          


          echo '<section id="main_page_container">';
          for ($i=0; $i < 3; $i++) { 
            echo '<aside id="column_container">';

            $j = 0;
            while ($j < 3 and $single_serie = $series->fetch()) {
              echo '<a class="movie_box" href="item.php?id='.$single_serie['serie_id'].'">
                  <img src="../imgs/series/'.$single_serie['serie_picture_path'].'"
                    class="movie_box_image" alt="'.$single_serie['title'].'" />
                  <article class="movie_box_tex_container">
                    <p class="movie_box_title">'.$single_serie['title'].'</p>
                    '.$single_serie['description'].'
                  </article>
                </a>
              ';
              $j++;
            }
            echo '</aside>';
          }

          echo '
            </section>

            <nav class="nav_section_button numbered_seccion_nav">
          ';

          if ( should_display_prev_button($page) ) {
            echo '
            <a class="section_number arrow" href="'.previous_page($section_id, $page).'">
              <img src="../imgs/leftarrow.svg" alt="Left">
            </a>';
          }

          if ( should_display_next_button($section_id, $page) ) {
            echo '
            <a class="section_number arrow" href="'.next_page($section_id, $page).'">
              <img src="../imgs/rightarrow.svg" alt="Right">
            </a>';
          }
        
          echo '</nav>';
        }
      ?>
    </main>

    <?php print_footer(); ?>
  </body>
</html>
