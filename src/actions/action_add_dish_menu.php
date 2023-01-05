<?php
  session_start();
  
  if (!isset($_SESSION['username'])){
    header('Location: index.php');
  }

  require_once('../database/connection.php');
  require_once('../database/restaurants.db.php');
  require_once('../database/dishes.db.php');

  $db = getDatabaseConnectionAPI();

  $dish = getDishWithPhoto($db,$_POST['dish']);

  addDishtoMenu($db,intval($_POST['restaurant']),$dish['name'],floatVal($_POST['price']));
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>