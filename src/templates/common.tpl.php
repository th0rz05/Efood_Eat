<?php

declare(strict_types=1);
require_once('database/users.php'); ?>

<?php function output_header(bool $owner, array $order = array())
{ ?>
    <!DOCTYPE html>
    <html lang="en-US">

    <head>
        <title>LTW Proj</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/layout.css" rel="stylesheet">
        <link href="css/responsive.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
        <script src="javascript/script.js" defer></script>
    </head>

    <body>
        <header>
            <button id="icon_header" onclick="toggleNav()">&#9776</button>
            <h1>eFood Eat</h1>
            <?php
            if (isset($_SESSION['username']) && $owner) drawLoginBox_ifOwner();
            else if (isset($_SESSION['username'])) drawLoginBox_ifUser();
            else drawLoginBox_ifNotLogIn();
            ?>
        </header>
        <nav class=navbar id="navbar">
            <ul>
                <li><a href="index.php">
                        <div class="icon_navbar"><i class="material-icons">home</i>
                        </div><span>Home</span>
                    </a></li>
                <li><a href="restaurants.php">
                        <div class="icon_navbar"><i class="material-icons">restaurant</i>
                        </div><span>Restaurants</span>
                    </a></li>
                <li><a href="dishes.php">
                        <div class="icon_navbar"><i class="material-icons">brunch_dining</i>
                        </div><span>Dishes</span>
                    </a></li>
                    <?php if (isset($_SESSION['username'])) { ?>
                <li><a href="my_orders.php">
                        <div class="icon_navbar"><i class="material-icons">list_alt</i>
                        </div><span>Orders</span>
                    </a></li>
                    <?php } ?>
                <?php if (isset($_SESSION['username'])) { ?>
                    <li><a href="favourites.php">
                            <div class="icon_navbar"><i class="material-icons">hotel_class</i>
                            </div><span>Favourites</span>
                        </a></li>
                <?php } ?>
            </ul>
        </nav>
        <?php if (isset($_SESSION['username'])) drawCartButton($order); ?>
        <main>
        <?php } ?>

        <?php function output_footer()
        { ?>
        </main>
        <footer>
            <p>&copy; LTW Proj</p>
        </footer>
    </body>

    </html>
<?php } ?>

<?php function drawLoginBox_ifNotLogIn()
{ ?>
    <div class="login_signup">
        <div id="signup"><a href="signup.php">SIGN UP</a></div>
        <div id="login"><a href="login.php">LOG IN</a></div>
    </div>
<?php } ?>

<?php function drawLoginBox_ifUser()
{ ?>
    <div class="user_header">
        <div id="usernamebox"><?= $_SESSION['username'] ?></div>
        <div class="rounded"></div>
        <div class="user_options">
            <a id="profile" href="profile.php">
                <div class="icon_optionsbox"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="25" height="25" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 20v-1a7 7 0 0 1 7-7v0a7 7 0 0 1 7 7v1m-7-8a4 4 0 1 0 0-8a4 4 0 0 0 0 8Z" />
                    </svg></div>
            </a>
            <a id="logout" href="actions/action_logout.php">
                <div class="icon_optionsbox"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="25" height="25" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="white" d="M16 17v-3H9v-4h7V7l5 5l-5 5M14 2a2 2 0 0 1 2 2v2h-2V4H5v16h9v-2h2v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9Z" />
                    </svg></div>
            </a>
        </div>
    </div>
<?php } ?>

<?php function drawLoginBox_ifOwner()
{ ?>
    <div class="owner_header">
        <div id="usernamebox"><?= $_SESSION['username'] ?></div>
        <hr class="rounded">
        </hr>
        <div class="owner_options">
            <a id="profile" href="profile.php">
                <div class="icon_optionsbox"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="25" height="25" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 20v-1a7 7 0 0 1 7-7v0a7 7 0 0 1 7 7v1m-7-8a4 4 0 1 0 0-8a4 4 0 0 0 0 8Z" />
                    </svg></div>
            </a>
            <a id="my_restaurants" href="my_restaurants.php">
                <div class="icon_optionsbox"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25" height="25" viewBox="0 0 122.88 116.67" xml:space="preserve" fill="white" fill-rule="evenodd" clip-rule="evenodd">
                        <path class="st0" d="M61.03,0C71.94,0,81.6,5.31,87.59,13.48h12.59c2.26,0,2.99,1.32,3.8,2.78v0.01c0.09,0.16,0.18,0.33,0.33,0.57 l18.09,28.81c0.33,0.53,0.48,1.08,0.48,1.63c0,0.73-0.26,1.4-0.7,1.99c-0.29,0.39-0.68,0.75-1.11,1.04l-0.14,0.1 c-0.79,0.5-1.77,0.81-2.66,0.81h-2.48V51.2v63.39c0,1.15-0.93,2.08-2.08,2.08H75.72H47.17H9.18c-1.15,0-2.08-0.93-2.08-2.08V51.2 H4.61c-0.89,0-1.87-0.32-2.66-0.81c-0.48-0.3-0.92-0.69-1.25-1.13C0.26,48.67,0,47.99,0,47.27c0-0.55,0.15-1.1,0.48-1.63 l18.09-28.81c0.11-0.17,0.22-0.38,0.33-0.58c0.81-1.45,1.54-2.77,3.8-2.77h11.77C40.46,5.31,50.12,0,61.03,0L61.03,0z M82.8,85.01 h13.95c0.14-4.21-2.34-6.59-5.25-7.19v-3.39h12.31v38.08H91.75v-9.13h5.8v-3.96H82.01v3.96h5.8v9.13H69.08v-9.13h5.8v-3.96H59.34 v3.96h5.81v9.13H53.08V74.43h12.31v3.48c-2.81,0.74-5.23,3.12-5.26,7.09h13.95c0.15-4.21-2.34-6.58-5.25-7.19v-3.39h19.22v3.48 C85.25,78.66,82.83,81.04,82.8,85.01L82.8,85.01z M33.29,91.35h1.8c0.29,0,0.53,0.24,0.53,0.53v6.29c0,0.29-0.24,0.53-0.53,0.53 h-1.8c-0.29,0-0.53-0.24-0.53-0.53v-6.29C32.77,91.58,33,91.35,33.29,91.35L33.29,91.35z M90.19,17.64 c2.4,4.57,3.76,9.77,3.76,15.28c0,5.05-1.14,9.84-3.18,14.12h22.94h4.57c0.03,0,0.07,0,0.11-0.01l-17.58-27.99 c-0.13-0.2-0.29-0.49-0.44-0.77l0,0l-0.04-0.08c-0.09-0.18-0.15-0.36-0.18-0.55H90.19L90.19,17.64z M88.41,51.2 c-5.9,8.83-15.96,14.64-27.38,14.64c-11.41,0-21.47-5.81-27.38-14.64H11.26v61.31h4.4V71.49h1.48h25.19v41.02h7.8V71.48h1.47h55.16 v41.03h4.87V51.2H88.41L88.41,51.2z M31.29,47.04c-2.04-4.28-3.18-9.07-3.18-14.12c0-5.52,1.36-10.71,3.76-15.28H22.7 c-0.17,0,0,0.3-0.18,0.63c-0.14,0.25-0.28,0.5-0.45,0.77L4.5,47.03c0.04,0.01,0.08,0.01,0.11,0.01h4.57H31.29L31.29,47.04z M39.36,74.43H18.62v38.08h20.74V74.43L39.36,74.43z M50.74,46.52l6.6-8l3.02,3.85l-5.82,7.4C52.31,52.6,48.19,49.61,50.74,46.52 L50.74,46.52L50.74,46.52z M58.45,28.3c0.63-2.05,0.34-3.8-2.02-6.4l-5.77-6.94c-0.82-0.96-2.75,0.45-1.94,1.62l4.61,5.69 c0.87,1.06-0.75,2.46-1.65,1.37l-4.77-5.88c-0.89-1.02-2.73,0.33-1.8,1.49c1.34,1.62,3.43,4.26,4.77,5.88 c0.93,0.95-0.48,2.35-1.41,1.17l-4.74-5.84c-0.7-0.76-1.83-0.29-2.13,0.6c-0.32,0.94,0.47,1.63,1.02,2.33l5.29,6.83 c1.64,1.9,3.48,3.03,5.61,2.39c0.33-0.1,0.73-0.3,1.16-0.56l14.21,18.34c0.76,0.99,2.24,1.09,3.2,0.3l0.22-0.18 c1.08-0.9,1.25-2.54,0.33-3.6L57.58,29.6C58.02,29.12,58.34,28.65,58.45,28.3L58.45,28.3L58.45,28.3z M62.47,32.3l2.34-2.84 C61.8,22,72.95,12.06,78.36,16.63c6.57,5.56-3.19,18.95-10.05,15.64l-2.77,3.52L62.47,32.3L62.47,32.3L62.47,32.3z"></path>
                    </svg></div>
            </a>
            <a id="logout" href="actions/action_logout.php">
                <div class="icon_optionsbox"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="25" height="25" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="white" d="M16 17v-3H9v-4h7V7l5 5l-5 5M14 2a2 2 0 0 1 2 2v2h-2V4H5v16h9v-2h2v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9Z" />
                    </svg></div>
            </a>
        </div>
    </div>
<?php } ?>

<?php function drawCartButton(array $order)
{ ?>
    <div id="cart_box">
        <div class="cartButton" onclick="toogleCartList()">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="white" class="bi bi-cart3" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <div id="numb_cart_items"><?= count($order) ?></div>
        </div>
        <?php drawCartList($order) ?>
    </div>
<?php } ?>

<?php function drawCartList(array $order)
{ ?>
    <div id="cart_list" class="cartList">
        <header>
            <h2>Cart List</h2>
        </header>
        <div class="cartListContent" <?php if (count($order) > 0) {
                                            echo "id=" . $order[0]['orderid'];
                                        } else {
                                            echo "id=0";
                                        } ?>>
            <table>
                <thead>
                    <tr>
                        <th>Dish</th>
                        <th>From</th>
                        <th>Qnt.</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php $total = 0;
                foreach ($order as $dish) {
                    $total += $dish['total'] ?>
                    <tr data-id=<?= $dish['name'] ?> restaurant=<?= $dish['restaurant'] ?> class="product">
                        <td><?= $dish['name'] ?></td>
                        <td id=<?= $dish['restaurantid'] ?>><?= $dish['restaurant'] ?></td>
                        <td><?= $dish['quantity'] ?></td>
                        <td class="price"><?= $dish['price'] ?></td>
                        <td class="price"><?= $dish['total'] ?></td>
                        <td class="delete"><a href="">X</a></td>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total:</th>
                        <th colspan="2" class="price"><?= $total ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
            <button id="add_order">ADD ORDER</button>
    </div>
<?php } ?>

<?php function output_user_profile(array $user)
{ ?>
    <div class="settings-page">
        <div class="settings-container">
            <h1 class="page-title">Profile</h1>
            <form action="actions/action_edit_info.php" method="post" class="form my-form">
                <div class="settings-section">
                    <h2 class="settings-title">Name</h2>
                    <div class="form my-form">
                        <div class="form-group">
                            <div class="input-group">
                                <input name="name" placeholder="<?= $user['name'] ?>" type="text" class="form-control" value="<?= $user['name'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="settings-section">
                    <h2 class="settings-title">Adress</h2>
                    <div class="form my-form">
                        <div class="form-group">
                            <div class="input-group">
                                <input name="adress" placeholder="<?= $user['adress'] ?>" type="text" class="form-control" value="<?= $user['adress'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="settings-section">
                    <h2 class="settings-title">Phone</h2>
                    <div class="form my-form">
                        <div class="form-group">
                            <div class="input-group">
                                <input name="phone" placeholder="<?= $user['phone'] ?>" type="text" class="form-control" value="<?= $user['phone'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="settings-section">
                    <h2 class="settings-title">Type</h2>
                    <div class="form my-form">
                        <div class="form-group">
                            <div class="input-group">
                                <?php if ($user['restaurant_owner'] == '1')
                                    $type = 'Owner';
                                else
                                    $type = 'Customer' ?>
                                <select class="form-control" name="type" value="<?= $type ?>">
                                    <option <?php if ($type == 'Customer') echo 'selected'; ?> value="customer" required>Customer</option>
                                    <option <?php if ($type == 'Owner') echo 'selected'; ?> value="owner" required>Owner </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-submit">
                    <button class="btn button" type="submit">Update Profile</button>
                </div>
            </form>
            <div class="settings-section">
                <h2 class="settings-title">Password</h2>
                <form class="form my-form" action="actions/action_edit_password.php" method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <input name="old_password" placeholder="Old Password" type="password" class="form-control" autocomplete="Old Password" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input name="new_password" placeholder="New Password" type="password" class="form-control" autocomplete="New Password" value="">
                        </div>
                    </div>
                    <div class="form-submit">
                        <button class="btn button" type="submit">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>


<?php function output_favourites(array $restaurants, array $dishes)
{ ?>
    <div class="favourites_page">
        <header>
            <h1>Favourites</h1>
        </header>
        <div class="tab">
            <button class="tablinks" onclick="openOpt(event, 'fav_restaurants_opt')" id="defaultOpen">Restaurants</button>
            <button class="tablinks" onclick="openOpt(event, 'fav_dishes_opt')">Dishes</button>
        </div>
        <div id="fav_dishes_opt" class="tabcontent">
            <?php foreach ($dishes as $dish) { ?>
                <div class="carouselbox_item">
                    <a href="dish.php?name=<?= $dish['name'] ?>&photo=<?= $dish['photo'] ?>">
                        <h3><?= $dish['name'] ?></h3>
                        <img src="images/dishes/<?= $dish['photo'] ?>.jpg">
                    </a>
                </div>
            <?php } ?>
        </div>
        <div id="fav_restaurants_opt" class="tabcontent">
            <?php foreach ($restaurants as $restaurant) { ?>
                <div class="carouselbox_item">
                    <a href="restaurant.php?id=<?= $restaurant['id'] ?>">
                        <h3><?= $restaurant['name'] ?></h3>
                        <img src="images/restaurants/<?= $restaurant['id'] ?>.jpg">
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<?php function output_my_orders(array $received, array $preparing, array $delivered)
{ ?>
    <div class="my_orders_page">
        <header>
            <h1>My Orders</h1>
        </header>
        <div class="my_orders_content">
            <div class="order_state_box">
                <header>
                    <h3>Ordered</h3>
                </header>
                <div class="order_state_box_content">
                    <?php foreach ($received as $order) { ?>
                        <div class="order">
                            <header>
                                <button id="dropdown_order_btn" onclick="if (document.getElementById('order_<?= $order['id'] ?>').style.display === 'block') {document.getElementById('order_<?= $order['id'] ?>').style.display = 'none';} else {document.getElementById('order_<?= $order['id'] ?>').style.display = 'block';}"><i class="material-icons">expand_more</i></button>
                                <p>
                                <p id="ord_hd_tt">Total price: </p>
                                <p class="price"><?= $order['price'] ?></p>
                                </p>
                                <p>
                                <p id="ord_hd_tt">Date: </p>
                                <p><?php echo $date = date('F j', intval($order['date'])); ?></p>
                                </p>
                            </header>
                            <div id="order_<?= $order['id'] ?>" class="dropdown_content">
                                <?php foreach ($order['dishes'] as $dish) { ?>
                                    <div class="dropdown_content_item">
                                        <p>
                                        <p id="ord_hd_tt">Restaurant: </p>
                                        <p><?= $dish['restaurant'] ?></p>
                                        </p>
                                        <p>
                                        <p id="ord_hd_tt">Dish: </p>
                                        <p><?= $dish['dish'] ?></p>
                                        </p>
                                        <p>
                                        <p id="ord_hd_tt">Quantity: </p>
                                        <p><?= $dish['quantity'] ?></p>
                                        </p>
                                        <p>
                                        <p id="ord_hd_tt">Notes: </p>
                                        <p><?= $dish['text'] ?></p>
                                        </p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="order_state_box">
                <header>
                    <h3>Preparing</h3>
                </header>
                <div class="order_state_box_content">
                    <?php foreach ($preparing as $order) { ?>
                        <div class="order">
                            <header>
                                <button id="dropdown_order_btn" onclick="if (document.getElementById('order_<?= $order['id'] ?>').style.display === 'block') {document.getElementById('order_<?= $order['id'] ?>').style.display = 'none';} else {document.getElementById('order_<?= $order['id'] ?>').style.display = 'block';}"><i class="material-icons">expand_more</i></button>
                                <p>
                                <p id="ord_hd_tt">Total price: </p>
                                <p class="price"><?= $order['price'] ?></p>
                                </p>
                                <p>
                                <p id="ord_hd_tt">Date: </p>
                                <p><?php echo $date = date('F j', intval($order['date'])); ?></p>
                                </p>
                            </header>
                            <div id="order_<?= $order['id'] ?>" class="dropdown_content">
                                <?php foreach ($order['dishes'] as $dish) { ?>
                                    <div class="dropdown_content_item">
                                        <p>
                                        <p id="ord_hd_tt">Restaurant: </p>
                                        <p><?= $dish['restaurant'] ?></p>
                                        </p>
                                        <p>
                                        <p id="ord_hd_tt">Dish: </p>
                                        <p><?= $dish['dish'] ?></p>
                                        </p>
                                        <p>
                                        <p id="ord_hd_tt">Quantity: </p>
                                        <p><?= $dish['quantity'] ?></p>
                                        </p>
                                        <p>
                                        <p id="ord_hd_tt">Notes: </p>
                                        <p><?= $dish['text'] ?></p>
                                        </p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="order_state_box">
                <header>
                    <h3>Delivered</h3>
                </header>
                <div class="order_state_box_content">
                    <?php foreach ($delivered as $order) { ?>
                        <div class="order">
                            <header>
                                <button id="dropdown_order_btn" onclick="if (document.getElementById('order_<?= $order['id'] ?>').style.display === 'block') {document.getElementById('order_<?= $order['id'] ?>').style.display = 'none';} else {document.getElementById('order_<?= $order['id'] ?>').style.display = 'block';}"><i class="material-icons">expand_more</i></button>
                                <p>
                                <p id="ord_hd_tt">Total price: </p>
                                <p class="price"><?= $order['price'] ?></p>
                                </p>
                                <p>
                                <p id="ord_hd_tt">Date: </p>
                                <p><?php echo $date = date('F j', intval($order['date'])); ?></p>
                                </p>
                            </header>
                            <div id="order_<?= $order['id'] ?>" class="dropdown_content">
                                <?php foreach ($order['dishes'] as $dish) { ?>
                                    <div class="dropdown_content_item">
                                        <p>
                                        <p id="ord_hd_tt">Restaurant: </p>
                                        <p><?= $dish['restaurant'] ?></p>
                                        </p>
                                        <p>
                                        <p id="ord_hd_tt">Dish: </p>
                                        <p><?= $dish['dish'] ?></p>
                                        </p>
                                        <p>
                                        <p id="ord_hd_tt">Quantity: </p>
                                        <p><?= $dish['quantity'] ?></p>
                                        </p>
                                        <p>
                                        <p id="ord_hd_tt">Notes: </p>
                                        <p><?= $dish['text'] ?></p>
                                        </p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>