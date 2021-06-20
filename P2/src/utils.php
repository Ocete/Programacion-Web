<?php
  // Recuerda que esta función sólo puede usarse si el buffer está vacío!
  $index_url = '/~pw77553417/pe2/';
  function back_to_index() {
    $index_url = '../index.php';
    header( "Location: $index_url" );
  }

  function compute_query($db, $query) {
    try {
      $result = $db->query( $query );
    } catch ( PDOException $e ) {
      echo "Consulta fallida: " . $e->getMessage();
      exit();
    }
    return $result;
  }

  function build_insert_query ($table, $campos, $dict_with_values) {
    $query = "insert into $table (" . implode(', ', $campos) .') values (';
    
    $values = array();
    foreach ( $campos as $c ) {
      array_push($values, '"'.$dict_with_values[$c].'"');
    }

    $query = $query . implode(", ", $values) . ");";

    return $query;
  }

  function build_update_query ($table, $campos, $dict_with_values, $id_name, $id_value) {
    $changes = array();
    foreach ( $campos as $c ) {
      array_push($changes, $c.'="'.$dict_with_values[$c].'"');
    }

    $query = "update $table set ".implode(", ", $changes).' where '.$id_name.' = "'.$id_value.'";';
    return $query;
  }

  function build_delete_query ($table, $id_name, $id_value) {
    return 'delete from '.$table.' where '.$id_name.' = "'.$id_value.'";';
  }

  function connect_to_db() {
    $dsn = "mysql:host=localhost;dbname=db77553417_pw2021";
    $usuario= "pw77553417";
    $password= "77553417";

    try {
      $conexion = new PDO( $dsn, $usuario, $password );
      $conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch ( PDOException $e ) {
      echo "Conexión fallida: " . $e->getMessage();
      exit();
    }

    return $conexion;
  }

  function get_all_items() {
    $db = connect_to_db();
    $query = "SELECT * FROM serie";
    $result = compute_query($db, $query);
    disconnect_from_db($db);
    return $result;
  }

  function get_all_sections() {
    $db = connect_to_db();
    $query = "SELECT * FROM section";
    $result = compute_query($db, $query);
    disconnect_from_db($db);
    return $result;
  }

  function disconnect_from_db($db) {
    $db = null;;
  }
?>