<?php
  session_start();
  
  if (!isset($_SESSION['username'])){
    header('Location: index.php');
  }
  require_once('../database/connection.php');
  require_once('../database/restaurants.db.php');



  $db = getDatabaseConnectionAPI();
  deleteReview($db,$_POST['id']);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>