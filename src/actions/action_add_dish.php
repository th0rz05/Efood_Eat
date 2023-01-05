<?php
  session_start();
  
  if (!isset($_SESSION['username'])){
    header('Location: index.php');
  }

  require_once('../database/connection.php');
  require_once('../database/restaurants.db.php');
  require_once('../database/dishes.db.php');

  $db = getDatabaseConnectionAPI();

  addDish($db,$_POST['name'],$_POST['category'],$_POST['photo']);

  addDishtoMenu($db,intval($_POST['restaurant']),$_POST['name'],floatVal($_POST['price']));
  $fileName = "../images/dishes/".$_POST['photo'].".jpg";
  move_uploaded_file($_FILES['image']['tmp_name'], $fileName);

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>