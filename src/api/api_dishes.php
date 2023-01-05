<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.php');
  require_once('../database/dishes.db.php');

  $db = getDatabaseConnectionAPI();

  $dishes = searchDishes($db, $_GET['search'], 10);

  echo json_encode($dishes);
?>