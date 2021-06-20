<?php
  session_start();
  require 'utils.php';

  unset($_SESSION['user']);
  unset($_SESSION['username']);
  unset($_SESSION['admin']);
  
  back_to_index();
?>
