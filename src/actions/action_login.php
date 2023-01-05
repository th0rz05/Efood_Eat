<?php
  session_start();                                         

  require_once('../database/users.php');
  require_once('../database/connection.php');

  $db = getDatabaseConnectionAPI();

  if (userExists($db,$_POST['username'], $_POST['password'])){
    $_SESSION['username'] = $_POST['username'];
    header('Location: ../index.php');
    } 

  header('Location: ../login.php');         
?>