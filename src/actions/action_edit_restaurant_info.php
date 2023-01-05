<?php
  session_start();
  
  if (!isset($_SESSION['username'])){
    header('Location: index.php');
  }
  require_once('../database/connection.php');
  require_once('../database/restaurants.db.php');

  $db = getDatabaseConnectionAPI();
  updateRestaurantInfo($db,$_POST['id'],$_POST['adress'],$_POST['category']);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>