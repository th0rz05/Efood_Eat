<?php
  session_start();

  require_once('templates/common.tpl.php');
  require_once('templates/mainPage.tpl.php');
  require_once('database/connection.php');
  require_once('database/mainPage.php');
  require_once('database/users.php');

  $db = getDatabaseConnection();

  $restaurants = getTop10Restaurants($db); 
  $dishes = getTop10Dishes($db);

  $owner = false;
  $order = array();
  if(isset($_SESSION['username'])){
    $owner = isOwner($db,$_SESSION['username']);
    $order = getUnfinishedOrder($db,$_SESSION['username']);
  }

  
  output_header($owner,$order);
  output_mainPage($restaurants, $dishes);
  output_footer();
?>
    