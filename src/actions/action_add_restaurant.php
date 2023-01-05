<?php
  session_start();
  
  if (!isset($_SESSION['username'])){
    header('Location: index.php');
  }

  require_once('../database/connection.php');
  require_once('../database/restaurants.db.php');



  $db = getDatabaseConnectionAPI();
  addRestaurant($db,$_POST['name'],$_POST['address'],$_POST['category'],$_SESSION['username'],$_POST['latitude'],$_POST['longitude']);
  $id = $db->lastInsertId();
  $fileName = "../images/restaurants/$id.jpg";
  move_uploaded_file($_FILES['image']['tmp_name'], $fileName);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>