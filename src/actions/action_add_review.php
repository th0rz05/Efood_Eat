<?php
  session_start();
  
  if (!isset($_SESSION['username'])){
    header('Location: index.php');
  }
  require_once('../database/connection.php');
  require_once('../database/restaurants.db.php');



  $db = getDatabaseConnectionAPI();
  addReview($db,$_POST['review_content'],$_POST['review_rating'],$_POST['customer'],$_POST['restaurant'],time());
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>