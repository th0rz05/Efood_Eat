<?php
  session_start();

  if (!isset($_SESSION['username'])){
    header('Location: index.php');
  }


  require_once('templates/common.tpl.php');
  require_once('database/connection.php');
  require_once('database/users.php');

  $db = getDatabaseConnection();

  $owner = false;
  $order = array();
  if(isset($_SESSION['username'])){
    $owner = isOwner($db,$_SESSION['username']);
    $order = getUnfinishedOrder($db,$_SESSION['username']);
  }
  
  $user = get_user_info($db,$_SESSION['username']);

  output_header($owner,$order);
  output_user_profile($user);
  output_footer();
?>