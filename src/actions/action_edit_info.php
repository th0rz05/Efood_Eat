<?php
  session_start();
  
  if (!isset($_SESSION['username'])){
    header('Location: index.php');
  }
  require_once('../database/connection.php');
  require_once('../database/users.php');

  $_POST['username'] = $_SESSION['username'];

  $owner = 0;
  if ($_POST['type']=='owner'){
    $owner = 1;
  }
  
  $db = getDatabaseConnectionAPI();
  if(updateUserInfo($db,$_POST['username'],$_POST['name'],$_POST['phone'],$_POST['adress'],$owner)) header('Location: ../index.php');
  else header('Location: ../profile.php');
?>