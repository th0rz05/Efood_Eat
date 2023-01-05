<?php declare(strict_types = 1);

    function searchDishes(PDO $db, string $search, int $count) : array {
        if($search!=''){
          $stmt = $db->prepare('  SELECT * FROM Dishes WHERE Name LIKE ? LIMIT ?');
          $stmt->execute(array($search . '%', $count));
        }
        else{
          $stmt = $db->prepare('  SELECT * FROM Dishes');
          $stmt->execute();
        }
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

      function updateDishPrice(PDO $db, string $dish, int $restaurant, float $price  ): bool{
        $stmt = $db->prepare("UPDATE Menu SET price = ? WHERE restaurant = ? AND dish = ?");
        $stmt->execute(array($price,$restaurant,$dish));
        return TRUE;
    }

    function deleteDish(PDO $db, string $dish, int $restaurant): bool{
      $stmt = $db->prepare("DELETE FROM Menu WHERE restaurant = ? AND dish = ?");
      $stmt->execute(array($restaurant,$dish));
      return TRUE;
  }

  function getFavDishes(PDO $db, string $customer): array{
    $stmt = $db->prepare("SELECT * FROM FavDishes,Dishes WHERE name=dish AND customer = ?");
    $stmt->execute(array($customer));
    
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

  function isFavouriteDish(PDO $db, string $customer, string $dish): bool{
    $stmt = $db->prepare("SELECT * FROM FavDishes WHERE customer=? AND dish=?");
    $stmt->execute(array($customer,$dish));

    if ($dish = $stmt->fetch()) {
      return TRUE;
    } else return FALSE;
}

  function addFavouriteDish(PDO $db, string $customer, string $dish): bool{
    $stmt = $db->prepare("INSERT INTO FavDishes VALUES (?,?)");
    $stmt->execute(array($customer,$dish));
    return TRUE;
}

function removeFavouriteDish(PDO $db, string $customer, string $dish): bool{
  $stmt = $db->prepare("DELETE FROM FavDishes WHERE customer = ? AND dish=?");
  $stmt->execute(array($customer,$dish));
  return TRUE;
}

function getDishWithPhoto(PDO $db, int $photo): array{
  $stmt = $db->prepare("SELECT name FROM Dishes WHERE photo = ?");
  $stmt->execute(array($photo));
  $dish = $stmt->fetch();
  return $dish;
}

function addDish(PDO $db,string $name,string $category, int $photo): bool{
  $stmt = $db->prepare("INSERT INTO Dishes VALUES(?,?,?)");
  $stmt->execute(array($name,$photo,$category));
  return TRUE;
}

?>