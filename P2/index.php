<?php
  session_start();
  require 'src/utils_html.php';

  // Preparamos 5 series para mostrarlas como destacadas
  $db = connect_to_db();
  $query = 'SELECT * FROM serie limit 5;';
  $series = compute_query($db, $query);

  // Obtenemos todas las secciones para los pop-ups
  $query2 = 'SELECT * FROM section;';
  $result = compute_query($db, $query2);

  // Configuramos un diccionario de [section_id] -> section_name
  // para que los pop-ups conozcan el nombre de la sección.
  $sections = array();
  foreach ($result as $s) {
    $sections[$s['section_id']] = $s['name'];
  }

  disconnect_from_db($db);
?>

<!DOCTYPE HTML>
<html lang = "en">
  <head>
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Trirong">
    <title>Nitflex</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="css/estilo.css" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    
    <script type="text/javascript" type="module">
      function show_pop_up(elem) {
        elem.classList.add('show');
      }

      function hide_pop_up(elem) {
        elem.classList.remove('show');
      }
    </script>

    <?php print_code_for_login_validation() ?>
  </head>

  <body>
    <?php print_header(); ?>

    <main>
      <?php print_nav_bar(); ?>

      <section id="main_page_container">
        <aside class="hide-tablet" id="left_column_container">
          <a id="featured_image_container" href="src/item.php?id=11">
            <img id="featured_img" src="imgs/series/got_featured.jpg" alt='Featured'/>
          </a>
        </aside>

        <aside class="hide-tablet" id="separator"></aside>

        <aside id="right_column_container">
          <h2 id="featured_list_header">Algunos elementos destacados</h2>

          <aside id="featured_list_container">
            <?php
              foreach ($series as $serie) {
                echo'
                <a class="movie_box popup"
                    onmouseover="show_pop_up(this)"
                    onmouseout="hide_pop_up(this)"
                    href="src/item.php?id='.$serie['serie_id'].'">

                  <span class="popuptext">'.$sections[ $serie['section_id'] ].'</span>

                  <img src="imgs/series/'.$serie['serie_picture_path'].'" class="movie_box_image"
                    alt="'.$serie['title'].'"/>
                  <p class="movie_box_title">'.$serie['title'].'</p>
                </a>
              ';
              }
            ?>
            <br>
          </aside>
        </aside>
      </section>
    </main>

    <?php print_footer(); ?>
  </body>
</html>