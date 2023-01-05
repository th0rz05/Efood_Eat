<?php declare(strict_types = 1);

    function searchRestaurants(PDO $db, string $search, int $count) : array {
        if($search!=''){
          $stmt = $db->prepare('  SELECT id,name FROM Restaurant WHERE name LIKE ? LIMIT ?');
          $stmt->execute(array($search . '%', $count));
        }
        else{
            $stmt = $db->prepare('SELECT id,name FROM Restaurant');
            $stmt->execute();
        }
        $restaurants = array();
        while ($restaurant = $stmt->fetch()) {
                $restaurants[] = array(
                    'id' => $restaurant['id'],
                    'name' => $restaurant['name'],
                );
          }
          return $restaurants;
        }
    
    function getRestaurant(PDO $db,int $id) : array {
      $stmt = $db->prepare('SELECT * FROM Restaurant WHERE id = ?');
      $stmt->execute(array($id));

      $restaurant = $stmt->fetch();

      return array(
        'id' => $restaurant['id'],
        'name' => $restaurant['name'],
        'adress' => $restaurant['adress'],
        'category' => $restaurant['category'],
        'owner' => $restaurant['owner_username'],
        'latitude' => $restaurant['latitude'],
        'longitude' => $restaurant['longitude'],
      );
    }

    function getMenu(PDO $db , int $id) : array {
      $stmt = $db->prepare('SELECT Dishes.name, Dishes.category ,Dishes.photo, Menu.price FROM Restaurant,Dishes,Menu 
                            WHERE Menu.restaurant = Restaurant.id AND Dishes.name = Menu.dish 
                            AND Restaurant.id = ?');
      
      $stmt->execute(array($id));

      $dishes = array();
      while ($dish = $stmt->fetch()) {
                $dishes[] = array(
                    'name' => $dish['name'],
                    'photo' => $dish['photo'],
                    'category' => $dish['category'],
                    'price' => $dish['price'],
                );
          }
          return $dishes;
    }

    function getReviewComment(PDO $db , int $id) : string {
      $stmt = $db->prepare('SELECT content FROM Comment WHERE review = ?');
      
      $stmt->execute(array($id));

      $comment = $stmt->fetch();

      if($comment==null){
        return "";
      }
      return $comment['content'];
    }


    function getReviews(PDO $db , int $id) : array {
      $stmt = $db->prepare('SELECT * FROM Review WHERE  restaurant = ?');
      
      $stmt->execute(array($id));

      $reviews = array();
      while ($review = $stmt->fetch()) {
                $comment = getReviewComment($db,intval($review['id']));
                $reviews[] = array(
                    'id' => $review['id'],
                    'date' => $review['date'],
                    'content' => $review['content'],
                    'rating' => $review['rating'],
                    'customer' => $review['customer'],
                    'comment' => $comment,
                );
          }
          return $reviews;
    }


    function isRestaurantOwner(int $id,string $owner_username) : bool {
      $db = getDatabaseConnection();
      $stmt = $db->prepare('SELECT owner_username FROM Restaurant WHERE id = ? AND owner_username = ?');
      $stmt->execute(array($id, $owner_username));

      if ($owner = $stmt->fetch()) {
        return TRUE;
      } else return FALSE;
    }

    function addReview(PDO $db, string $content,int $rating,string $customer, int $restaurant, int $date): bool{
      $stmt = $db->prepare("INSERT INTO Review(date,content,rating,customer,restaurant) 
                            VALUES(?,?,?,?,?)");
      $stmt->execute(array($date,$content,$rating,$customer,$restaurant));
      return TRUE;
  }

  function deleteReview(PDO $db, int $id): bool{
    $stmt = $db->prepare("DELETE FROM Review WHERE id = ?");
    $stmt->execute(array($id));
    return TRUE;
}

function addComment(PDO $db, string $content,int $review, int $date): bool{
  $stmt = $db->prepare("INSERT INTO Comment(date,content,review) 
                        VALUES(?,?,?)");
  $stmt->execute(array($date,$content,$review));
  return TRUE;
}

function updateRestaurantInfo(PDO $db, int $id, string $adress, string $category): bool{
  $stmt = $db->prepare("UPDATE Restaurant SET adress = ? , category = ?  WHERE id = ?");
  $stmt->execute(array($adress,$category,$id));
  return TRUE;
}

function getFavRestaurants(PDO $db, string $customer): array{
  $stmt = $db->prepare("SELECT * FROM FavRestaurants,Restaurant WHERE restaurant=id AND customer = ?");
  $stmt->execute(array($customer));
  
  $restaurants = array();
        while ($restaurant = $stmt->fetch()) {
                $restaurants[] = array(
                    'id' => $restaurant['id'],
                    'name' => $restaurant['name'],
                );
          }
  return $restaurants;     
}

function getRestaurantsWithDish(PDO $db, string $dish): array{
  $stmt = $db->prepare("SELECT * FROM Menu,Restaurant WHERE  restaurant = id AND dish = ? ORDER BY price");
  $stmt->execute(array($dish));
  
  $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
              $restaurants[] = array(
                  'id' => $restaurant['id'],
                  'name' => $restaurant['name'],
                  'price' => $restaurant['price']
              );
        }
  return $restaurants;     
}

function getMyRestaurants(PDO $db, string $owner): array{
  $stmt = $db->prepare("SELECT * FROM Restaurant WHERE  owner_username = ?");
  $stmt->execute(array($owner));
  
  $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
              $restaurants[] = array(
                  'id' => $restaurant['id'],
                  'name' => $restaurant['name'],
              );
        }
  return $restaurants;     
}

function isFavouriteRestaurant(PDO $db, string $customer, int $restaurant): bool{
  $stmt = $db->prepare("SELECT * FROM FavRestaurants WHERE customer=? AND restaurant=?");
  $stmt->execute(array($customer,$restaurant));

  if ($restaurant = $stmt->fetch()) {
    return TRUE;
  } else return FALSE;
}

function addFavouriteRestaurant(PDO $db, string $customer, int $restaurant): bool{
  $stmt = $db->prepare("INSERT INTO FavRestaurants VALUES (?,?)");
  $stmt->execute(array($customer,$restaurant));
  return TRUE;
}

function removeFavouriteRestaurant(PDO $db, string $customer, int $restaurant): bool{
$stmt = $db->prepare("DELETE FROM FavRestaurants WHERE customer = ? AND restaurant=?");
$stmt->execute(array($customer,$restaurant));
return TRUE;
}

function deleteRestaurant(PDO $db, int $restaurant): bool{
  $stmt = $db->prepare("DELETE FROM Comment WHERE review IN (SELECT id FROM Review WHERE restaurant = ?)");
  $stmt->execute(array($restaurant));
  $stmt = $db->prepare("DELETE FROM FavRestaurants WHERE restaurant = ?");
  $stmt->execute(array($restaurant));
  $stmt = $db->prepare("DELETE FROM Menu WHERE restaurant = ?");
  $stmt->execute(array($restaurant));
  $stmt = $db->prepare("DELETE FROM OrderDishes WHERE restaurant = ?");
  $stmt->execute(array($restaurant));
  $stmt = $db->prepare("DELETE FROM Review WHERE restaurant = ?");
  $stmt->execute(array($restaurant));
  $stmt = $db->prepare("DELETE FROM Restaurant WHERE id = ?");
  $stmt->execute(array($restaurant));
  return TRUE;
}

function addRestaurant(PDO $db, string $name, string $adress, string $category, string $owner, string $latitude, string $longitude): bool{
  $stmt = $db->prepare("INSERT INTO Restaurant(name,adress,category,owner_username,latitude,longitude)
                         VALUES(?,?,?,?,?,?)");
  $stmt->execute(array($name,$adress,$category,$owner,$latitude,$longitude));
  return TRUE;
}



function getRestaurantRating(PDO $db, int $restaurant): float{
  $stmt = $db->prepare("SELECT  avg(Review.rating) as rating
                      FROM Restaurant JOIN Review ON Restaurant.id = Review.restaurant 
                      WHERE Restaurant.id = ?
                      GROUP BY Restaurant.id");

  $stmt->execute(array($restaurant));

  $rating = $stmt->fetch();

  if($rating==null){
    return 0;
  }

  return floatVal($rating['rating']);
}

function getOrderDishes(PDO $db , int $orderid) : array {
  $stmt = $db->prepare('SELECT dish,name,quantity,text FROM Orders,OrderDishes,Restaurant 
                        WHERE orderid = Orders.id AND restaurant = Restaurant.id AND orderid = ?');
  $stmt->execute(array($orderid));

  $dishes = array();
  while ($dish = $stmt->fetch()) {
            $dishes[] = array(
                'dish' => $dish['dish'],
                'restaurant' => $dish['name'],
                'quantity' => $dish['quantity'],
                'text' => $dish['text'],
            );
      }
      return $dishes;
}

function getOrders(PDO $db , int $restaurant, string $type) : array {
  $stmt = $db->prepare('SELECT * FROM Orders,OrderDishes WHERE orderid = id AND restaurant = ? AND state = ?
                        GROUP BY orderid');
  $stmt->execute(array($restaurant,$type));

  $orders = array();
  while ($order = $stmt->fetch()) {
            $dishes = getOrderDishes($db,intval($order['id']));
            $orders[] = array(
                'id' => $order['id'],
                'date' => $order['date'],
                'price' => $order['price'],
                'state' => $order['state'],
                'customer' => $order['customer'],
                'dishes' => $dishes,
            );
      }
      return $orders;
}

function addDishToMenu(PDO $db ,int $restaurant,string $dish, float $price): bool{
  $stmt = $db->prepare("INSERT INTO Menu VALUES(?,?,?)");
  $stmt->execute(array($dish,$restaurant,$price));
  return TRUE;
  }
?>