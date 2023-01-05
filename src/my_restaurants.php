<?php
  session_start();


  if (!isset($_SESSION['username'])){
    header('Location: index.php');
  }

  
  require_once('templates/common.tpl.php');
  require_once('database/connection.php');
  require_once('database/restaurants.db.php');
  require_once('templates/restaurants.tpl.php');
  

  $db = getDatabaseConnection();
  $restaurants = getMyRestaurants($db,$_SESSION['username']);

  $owner = false;
  $order = array();
  if(isset($_SESSION['username'])){
    $owner = isOwner($db,$_SESSION['username']);
    $order = getUnfinishedOrder($db,$_SESSION['username']);
  }

  output_header($owner,$order);
  output_myrestaurants_page($restaurants);
  output_footer();
?>