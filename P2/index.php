<?php
  session_start();
  require 'src/utils_html.php';

  $db = connect_to_db();
  $query = 'SELECT * FROM serie limit 5;';
  $series = compute_query($db, $query);

  $query = 'SELECT * FROM section;';
  $result = compute_query($db, $query);

  $sections = array();
  foreach ($result as $s) {
    echo print_r($s).'<br>';
    echo 
    $sections[$s['section_id']] = $s['name'];
  }

  echo print_r($sections);

  disconnect_from_db($db);
?>

<!DOCTYPE HTML>
<html lang = "en">
  <head>
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Trirong">
    <title>Netflix</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="css/estilo.css" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />

    <script type="text/javascript">
      function hovering(elem) {
        elem.classList.toggle("show");
        console.log('hovering');
      }
    </script>
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
          <h2 id="featured_list_header"> Algunos elementos destacados </h2>

          <aside id="featured_list_container">
            <?php
              foreach ($series as $serie) {
                echo'
                <a class="movie_box" onmouseover="hovering(this)"
                    href="src/item.php?id='.$serie['serie_id'].'">
                  <img src="imgs/series/'.$serie['serie_picture_path'].'" class="movie_box_image"
                    alt="'.$serie['title'].'"/>
                  <p class="movie_box_title">'.$serie['title'].'</p>

                  <span class="popuptext" id="myPopup">Sección: '.
                    $sections[ $serie['section_id'] ].'</span>
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
