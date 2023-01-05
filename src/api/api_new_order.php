<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.php');
  require_once('../database/users.php');

  $db = getDatabaseConnectionAPI();

  if($_POST['action']=='add'){
    addOrder($db,$_POST['customer']);
  }
  
?>