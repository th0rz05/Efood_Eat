<?php
  session_start();
  
  if (!isset($_SESSION['username'])){
    header('Location: index.php');
  }
  require_once('../database/connection.php');
  require_once('../database/users.php');

  $db = getDatabaseConnectionAPI();
  makeOrder($db,$_SESSION['username']);
?>