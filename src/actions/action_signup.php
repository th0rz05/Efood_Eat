<?php
  session_start();                                         // starts the session

  require_once('../database/connection.php');                 // database connection
  require_once('../database/users.php');                       // user table queries


  $username = $_POST['username'];
  $password = sha1($_POST['password']);
  $name = $_POST['name'];
  $adress = $_POST['adress'];
  $phone = $_POST['phone'];
  $owner = 0;
  if ($_POST['role']=='owner'){
      $owner = 1;
  }

  $db = getDatabaseConnectionAPI();

  if(!usernameExists($username,$db)){
    $stmt = $db->prepare('  INSERT INTO Users 
                            VALUES (?, ?,
                             ?, ?, ?,
                             ?);');

    $stmt->execute(array($username,$password,$name,$phone,$adress,$owner));

    $_SESSION['username'] = $_POST['username'];

    header('Location: index.php'); 
  }
  else{
    header('Location:'.$_SERVER['HTTP_REFERER'] ); 
  }

         
?>