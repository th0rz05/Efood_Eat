<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.php');
  require_once('../database/restaurants.db.php');

  $db = getDatabaseConnectionAPI();

  if($_POST['action']=='add'){
    addFavouriteRestaurant($db,$_SESSION['username'],intval($_POST['id']));
  }
  if($_POST['action']=='remove'){
    removeFavouriteRestaurant($db,$_SESSION['username'],intval($_POST['id']));
  }
  
?>