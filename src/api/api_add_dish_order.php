<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.php');
  require_once('../database/users.php');

  $db = getDatabaseConnectionAPI();

  if($_POST['action']=='add'){
    addDishToOrder($db,$_POST['customer'],$_POST['dish'],intval($_POST['restaurant']),$_POST['text']);
  }
  if($_POST['action']=='remove'){
    removeDishfromOrder($db,$_POST['customer'],$_POST['dish'],intval($_POST['restaurant']));
  }
  if($_POST['action']=='update'){
    updateDishInOrder($db,$_POST['customer'],$_POST['dish'],intval($_POST['restaurant']));
  }
  
?>