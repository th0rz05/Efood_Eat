<?php
  session_start();
  
  if (!isset($_SESSION['username'])){
    header('Location: index.php');
  }
  require_once('../database/connection.php');
  require_once('../database/dishes.db.php');



  $db = getDatabaseConnectionAPI();
  deleteDish($db,$_POST['name'],intval($_POST['restaurant']));
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>