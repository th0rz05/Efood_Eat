<?php declare(strict_types = 1);

function getTop10Restaurants(PDO $db) : array {
    $stmt = $db->prepare('  SELECT Restaurant.id,Restaurant.name
                            FROM Restaurant JOIN Review ON Restaurant.id = Review.restaurant
                            GROUP BY Restaurant.id
                            ORDER BY avg(Review.rating) DESC
                            LIMIT 10');
    $stmt->execute();
    $restaurants = array();
    while ($restaurant = $stmt->fetch()) {
            $restaurants[] = array(
                'id' => $restaurant['id'],
                'name' => $restaurant['name'],
            );
      }
      return $restaurants;
}

    function getAllRestaurants(PDO $db) : array {
        $stmt = $db->prepare('  SELECT id,name
                                FROM Restaurant');
        $stmt->execute();
        $restaurants = array();
        while ($restaurant = $stmt->fetch()) {
                $restaurants[] = array(
                    'id' => $restaurant['id'],
                    'name' => $restaurant['name'],
                );
          }
          return $restaurants;
    }

    function getAllDishes(PDO $db) : array {
        $stmt = $db->prepare('  SELECT *
                                FROM Dishes');
        $stmt->execute();
        $dishes = array();
        while ($dish = $stmt->fetch()) {
                $dishes[] = array(
                    'name' => $dish['name'],
                    'photo' => $dish['photo'],
                    'category' => $dish['category'],
                );
          }
          return $dishes;
    }
    
    function gettop10Dishes(PDO $db) : array {
        $stmt = $db->prepare('SELECT name,count(*) as count ,photo,category 
                                FROM OrderDishes,Dishes WHERE dish = name 
                                GROUP BY dish ORDER BY count DESC LIMIT 10');
        $stmt->execute();
        $dishes = array();
        while ($dish = $stmt->fetch()) {
                $dishes[] = array(
                    'name' => $dish['name'],
                    'photo' => $dish['photo'],
                    'category' => $dish['category'],
                );
          }
          return $dishes;
    }

    function updateDishes(PDO $db, int $id, string $title , string $introduction , string $fulltext){
        //$stmt = $db->prepare("UPDATE news SET title = '$title' , introduction = '$introduction' , fulltext = '$fulltext' WHERE id = ?");
        //$stmt->execute(array($id));
    }

    function updateRestaurants(PDO $db, int $id, string $title , string $introduction , string $fulltext){
        //$stmt = $db->prepare("UPDATE news SET title = '$title' , introduction = '$introduction' , fulltext = '$fulltext' WHERE id = ?");
        //$stmt->execute(array($id));
    }
?>