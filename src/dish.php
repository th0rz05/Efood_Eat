<?php
  session_start();

  require_once('templates/common.tpl.php');
  require_once('database/connection.php');
  require_once('templates/dishes.tpl.php');
  require_once('database/restaurants.db.php');
  require_once('database/dishes.db.php');

  
  $db = getDatabaseConnection();
  $restaurants = getRestaurantsWithDish($db, $_GET['name']);

  $favourite = false;

  if (isset($_SESSION['username'])){
    $favourite = isFavouriteDish($db,$_SESSION['username'],$_GET['name']);
  }
  
  $dish = array('photo' => $_GET['photo'], 'name' => $_GET['name']);

  $owner = false;
  $order = array();
  if(isset($_SESSION['username'])){
    $owner = isOwner($db,$_SESSION['username']);
    $order = getUnfinishedOrder($db,$_SESSION['username']);
  }

  output_header($owner,$order);
  output_dish($dish,$restaurants,$favourite);
  output_footer();
?>