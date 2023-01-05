<?php
  session_start();

  require_once('templates/common.tpl.php');
  require_once('database/connection.php');
  require_once('database/mainPage.php');
  require_once('templates/dishes.tpl.php');

  $db = getDatabaseConnection();
  $dishes = getAllDishes($db);

  $owner = false;
  $order = array();
  if(isset($_SESSION['username'])){
    $owner = isOwner($db,$_SESSION['username']);
    $order = getUnfinishedOrder($db,$_SESSION['username']);
  }

  output_header($owner,$order);
  output_dishes_page($dishes);
  output_footer();;
?>