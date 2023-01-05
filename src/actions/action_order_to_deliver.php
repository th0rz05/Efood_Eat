<?php
  session_start();
  
  if (!isset($_SESSION['username'])){
    header('Location: index.php');
  }
  require_once('../database/connection.php');
  require_once('../database/users.php');

  $db = getDatabaseConnectionAPI();
  changeOrderToDeliver($db,intval($_POST['orderid']));
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>