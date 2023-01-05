<?php declare(strict_types = 1);

    function userExists(PDO $db,string $username , string $password) : bool{
        $stmt = $db->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
        $stmt->execute(array($username, sha1($password)));
        if ($user = $stmt->fetch()) {
            return TRUE;
          } else return FALSE;
    }

    function usernameExists(string $username, PDO $db) : bool{
        $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute(array($username));
        if ($user = $stmt->fetch()) {
            return TRUE;
          } else return FALSE;
    }


    function get_user_info(PDO $db,string $username) : array {
        $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute(array($username));
        $user = $stmt->fetch();
        return $user;
    }

    function isOwner(PDO $db,string $username) : bool {
        $stmt = $db->prepare('SELECT * FROM users WHERE username = ? AND restaurant_owner = TRUE');
        $stmt->execute(array($username));
        if ($user = $stmt->fetch()) {
            return TRUE;
          } else return FALSE;
    }

    function updateUserInfo(PDO $db, string $username, string $name, string $phone , string $adress, bool $owner ): bool{
        $stmt = $db->prepare("UPDATE users SET name = ? , phone = ? , adress = ? , restaurant_owner = ? WHERE username = ?");
        $stmt->execute(array($name, $phone, $adress, $owner,$username));
        return TRUE;
    }

    function updateUserPassword(PDO $db, string $username, string $old_password, string $new_password): bool{
        if(userExists($db,$username,$old_password)){
            $stmt = $db->prepare("UPDATE users SET password = ? WHERE username = ?");
            $stmt->execute(array(sha1($new_password),$username));
            return TRUE;
        }
        else return FALSE;
    }

    function getUnfinishedOrder(PDO $db,string $username) : array {
        $stmt = $db->prepare('SELECT Restaurant.id as restaurantid,orderid,Menu.dish as name,name as restaurant,quantity,Menu.price as price,quantity*Menu.price as total 
                                FROM Orders,OrderDishes,Restaurant,Menu 
                                WHERE customer = ? AND orderid=Orders.id
                                AND OrderDishes.restaurant = Restaurant.id 
                                AND Menu.dish = OrderDishes.dish AND Menu.restaurant = OrderDishes.restaurant
                                AND Orders.state = "ordering"');
        $stmt->execute(array($username));
        $order = array();
        while ($dish = $stmt->fetch()) {
                $order[] = array(
                    'name' => $dish['name'],
                    'restaurant' => $dish['restaurant'],
                    'quantity' => $dish['quantity'],
                    'price' => $dish['price'],
                    'total' => $dish['total'],
                    'orderid' => $dish['orderid'],
                    'restaurantid' => $dish['restaurantid'],
                );
          }
          return $order;
    }

    function addDishToOrder(PDO $db,string $customer, string $dish,int $restaurant, string $text) : bool{
        $stmt = $db->prepare("SELECT id FROM Orders WHERE customer = ? AND state = ? ");
        $stmt->execute(array($customer,'ordering'));
        $order = $stmt->fetch();
        $stmt = $db->prepare("INSERT INTO OrderDishes VALUES(?,?,?,1,?)");
        $stmt->execute(array($order['id'],$dish,$restaurant,$text));
        return TRUE;
    }

    function updateDishInOrder(PDO $db,string $customer, string $dish,int $restaurant) : bool{
        $stmt = $db->prepare("SELECT id FROM Orders WHERE customer = ? AND state = ? ");
        $stmt->execute(array($customer,'ordering'));
        $order = $stmt->fetch();
        $stmt = $db->prepare("UPDATE OrderDishes SET quantity = quantity + 1 WHERE orderid = ? AND dish = ? AND restaurant = ?");
        $stmt->execute(array($order['id'],$dish,$restaurant));
        return TRUE;
    }

    function removeDishfromOrder(PDO $db,string $customer, string $dish,int $restaurant) : bool{
        $stmt = $db->prepare("SELECT id FROM Orders WHERE customer = ? AND state = ? ");
        $stmt->execute(array($customer,'ordering'));
        $order = $stmt->fetch();
        $stmt = $db->prepare("DELETE FROM OrderDishes WHERE orderid = ? AND dish = ? AND restaurant = ?");
        $stmt->execute(array($order['id'],$dish,$restaurant));
        return TRUE;
    }

    function addOrder(PDO $db,string $customer) : bool{
        $stmt = $db->prepare("SELECT id FROM Orders WHERE customer = ? AND state = ? ");
        $stmt->execute(array($customer,'ordering'));
        $order = $stmt->fetch();
        if($order){return FALSE;}
        $stmt = $db->prepare("INSERT INTO Orders(date,price,state,customer) VALUES (?,0,'ordering',?)");
        $stmt->execute(array(time(),$customer));
        return TRUE;
    }

    function getUserOrderDishes(PDO $db , int $orderid) : array {
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
      
      function getUserOrders(PDO $db , string $customer, string $type) : array {
        $stmt = $db->prepare('SELECT * FROM Orders,OrderDishes WHERE orderid = id AND customer = ? AND state = ?
                              GROUP BY orderid');
        $stmt->execute(array($customer,$type));
      
        $orders = array();
        while ($order = $stmt->fetch()) {
                  $dishes = getUserOrderDishes($db,intval($order['id']));
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

      function makeOrder(PDO $db,string $customer) : bool{
        $stmt = $db->prepare("UPDATE Orders SET date = ? WHERE customer = ? AND state = ? ");
        $stmt->execute(array(time(),$customer,'ordering'));
        $stmt = $db->prepare("UPDATE Orders SET state = ? WHERE customer = ? AND state = ? ");
        $stmt->execute(array('received',$customer,'ordering'));
        return TRUE;
    }

    function changeOrderToPrepare(PDO $db,int $orderid) : bool{
        $stmt = $db->prepare("UPDATE Orders SET state = ? WHERE id = ? ");
        $stmt->execute(array('preparing',$orderid));
        return TRUE;
    }

    function changeOrderToDeliver(PDO $db,int $orderid) : bool{
        $stmt = $db->prepare("UPDATE Orders SET state = ? WHERE id = ? ");
        $stmt->execute(array('delivered',$orderid));
        return TRUE;
    }
?>