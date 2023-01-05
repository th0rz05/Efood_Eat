<?php
  session_start();
  
  if (!isset($_SESSION['username'])){
    header('Location: index.php');
  }
  require_once('../database/connection.php');
  require_once('../database/dishes.db.php');



  $db = getDatabaseConnectionAPI();
  updateDishPrice($db,$_POST['name'],intval($_POST['restaurant']),$_POST['price']);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>