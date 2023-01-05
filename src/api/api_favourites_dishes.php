<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.php');
  require_once('../database/dishes.db.php');

  $db = getDatabaseConnectionAPI();

  if($_POST['action']=='add'){
    addFavouriteDish($db,$_SESSION['username'],$_POST['dish']);
  }
  if($_POST['action']=='remove'){
    removeFavouriteDish($db,$_SESSION['username'],$_POST['dish']);
  }
  
?>