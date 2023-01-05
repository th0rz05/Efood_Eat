<?php
  session_start();
  
  if (!isset($_SESSION['username'])){
    header('Location: index.php');
  }
  require_once('../database/connection.php');
  require_once('../database/users.php');

  $_POST['username'] = $_SESSION['username'];

  $db = getDatabaseConnectionAPI();
  if(updateUserPassword($db,$_POST['username'],$_POST['old_password'],$_POST['new_password'])) header('Location: ../index.php');
  else header('Location: ../profile.php');
?>