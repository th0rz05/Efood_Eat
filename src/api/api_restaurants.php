<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.php');
  require_once('../database/restaurants.db.php');

  $db = getDatabaseConnectionAPI();

  $restaurants = searchRestaurants($db, $_GET['search'], 10);

  echo json_encode($restaurants);
?>