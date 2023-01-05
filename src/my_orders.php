<?php
  session_start();

  if (!isset($_SESSION['username'])){
    header('Location: index.php');
  }

  require_once('templates/common.tpl.php');
  require_once('database/connection.php');
  require_once('database/restaurants.db.php');
  require_once('database/dishes.db.php');
  require_once('database/users.php');

  $db = getDatabaseConnection();
  

  $owner = false;
  $order = array();
  if(isset($_SESSION['username'])){
    $owner = isOwner($db,$_SESSION['username']);
    $order = getUnfinishedOrder($db,$_SESSION['username']);
  }

  $received = getUserOrders($db,$_SESSION['username'],"received");
  $preparing = getUserOrders($db,$_SESSION['username'],"preparing");
  $delivered = getUserOrders($db,$_SESSION['username'],"delivered");

  output_header($owner,$order);
  output_my_orders($received, $preparing, $delivered);
  output_footer();
?>