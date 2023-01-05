<?php
  session_start();
  
  if (!isset($_SESSION['username'])){
    header('Location: index.php');
  }

  require_once('../database/connection.php');
  require_once('../database/restaurants.db.php');



  $db = getDatabaseConnectionAPI();
  deleteRestaurant($db,$_POST['restaurant']);
  unlink("../images/restaurants/".$_POST['restaurant'].".jpg");
  header('Location: ../index.php');
?>