<?php
  session_start();

  require_once('templates/common.tpl.php');
  require_once('database/connection.php');
  require_once('templates/restaurants.tpl.php');
  require_once('database/restaurants.db.php');
  require_once('database/mainPage.php');

  

  $db = getDatabaseConnection();
  $restaurant = getRestaurant($db, $_GET['id']);
  $dishes = getMenu($db, $_GET['id']);
  $reviews = getReviews($db, $_GET['id']);
  $rating = getRestaurantRating($db,$_GET['id']);
  $received = getOrders($db,$_GET['id'],"received");
  $preparing = getOrders($db,$_GET['id'],"preparing");
  $delivered = getOrders($db,$_GET['id'],"delivered");
  $alldishes = getAllDishes($db);

  $favourite = false;

  if (isset($_SESSION['username'])){
    $favourite = isFavouriteRestaurant($db,$_SESSION['username'],$_GET['id']);
  }

  $owner = false;
  $order = array();
  if(isset($_SESSION['username'])){
    $owner = isOwner($db,$_SESSION['username']);
    $order = getUnfinishedOrder($db,$_SESSION['username']);
  }

  output_header($owner,$order);
  output_restaurant($restaurant, $dishes, $reviews,$favourite,$rating, $received,$preparing,$delivered,$alldishes);
  output_footer();
?>