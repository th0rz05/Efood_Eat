<?php

declare(strict_types=1); ?>
<?php function output_restaurants_page(array $restaurants)
{ ?>
    <section class="restaurants_page">
        <header>
            <input id="searchrestaurant" type="text" placeholder="Search">
        </header>
        <div class="restaurants_box">
            <?php foreach ($restaurants as $restaurant) { ?>
                <div class="carouselbox_item">
                    <a href="restaurant.php?id=<?= $restaurant['id'] ?>">
                        <h3><?= $restaurant['name'] ?></h3>
                        <img src="images/restaurants/<?= $restaurant['id'] ?>.jpg">
                    </a>
                </div>
            <?php } ?>
        </div>
    </section>
<?php } ?>

<?php function output_myrestaurants_page(array $restaurants)
{ ?>
    <div class="my_restaurants_page">
        <header>
            <h1>My Restaurants</h1>
        </header>
        <div class="restaurants_box">
            <?php foreach ($restaurants as $restaurant) { ?>
                <div class="carouselbox_item">
                    <a href="restaurant.php?id=<?= $restaurant['id'] ?>">
                        <h3><?= $restaurant['name'] ?></h3>
                        <img src="images/restaurants/<?= $restaurant['id'] ?>.jpg">
                    </a>
                </div>
            <?php } ?>
            <div class="carouselbox_item">
                <button id="add_new_restaurant" onclick="document.getElementById('id01').style.display='block'">
                    <i class="material-icons">add_circle</i>
                </button>
            </div>
        </div>

        <div id="id01" class="modal">
            <div id="add_forms">
                <form action="actions/action_add_restaurant.php" method="post" enctype="multipart/form-data"">
                    <h1>Add Restaurant</h1>
                    <input placeholder="Name" type="text" name="name">
                    <input placeholder="Category" type="text" name="category">
                    <input placeholder="Address" type="text" name="address">
                    <input placeholder="Latitude" type="text" name="latitude">
                    <input placeholder="Longitude" type="text" name="longitude">
                    <input placeholder="Image" type="file" name="image" id="image">
                    <button type="button" onclick="document.getElementById('id01').style.display='none'" class="button">Cancel</button>
                    <button type="submit" onclick="document.getElementById('id01').style.display='none'" class="button">Add</button>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<?php function output_restaurant(array $restaurantInfo, array $dishes, array $reviews, bool $favourite, float $rating, array $received, array $preparing, array $delivered, array $alldishes)
{ ?>
    <section class="restaurant_info_page">
        <header>
            <h2><?= $restaurantInfo['name'] ?></h2>
            <div>
                <?php for ($i = 0; $i < $rating; $i++) echo '<i class="material-icons checked">star</i>'; ?>
            </div>
            <?php if (isset($_SESSION['username'])) { ?>
                <div class="fav_icon" id="<?= $restaurantInfo['id'] ?>" <?php if ($favourite) {
                                                                            echo "hidden";
                                                                        } ?>>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                    </svg>
                </div>
                <div class="fav_icon_selected" id="<?= $restaurantInfo['id'] ?>" <?php if (!$favourite) {
                                                                                        echo "hidden";
                                                                                    } ?>>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="yellow" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                    </svg>
                </div>
            <?php } ?>
            <img src="images/restaurants/<?= $restaurantInfo['id'] ?>.jpg">
        </header>
        <div class="tab">
            <button class="tablinks" onclick="openOpt(event, 'dishes_opt')" id="defaultOpen">Dishes</button>
            <button class="tablinks" onclick="openOpt(event, 'reviews_opt')">Reviews</button>
            <button class="tablinks" onclick="openOpt(event, 'about_opt')">About</button>
            <?php if (isset($_SESSION['username']) && isRestaurantOwner(intval($restaurantInfo['id']), $_SESSION['username'])) { ?>
                <button class="tablinks" onclick="openOpt(event, 'orders_opt')">Orders</button>
                <button id="delete_restaurant" onclick="document.getElementById('id01').style.display='block'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                    </svg>
                </button>
            <?php } ?>
        </div>

        <div id="id01" class="modal">
            <form class="modal-content" action="actions/action_delete_restaurant.php" method="post">
                <div class="container">
                    <h1>Delete Restaurant</h1>
                    <p>Are you sure you want to delete your restaurant?</p>
                    <input name="restaurant" type="hidden" value="<?= $restaurantInfo['id'] ?>">
                    <div class="clearfix">
                        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                        <button type="submit" onclick="document.getElementById('id01').style.display='none'" class="deletebtn">Delete</button>
                    </div>
                </div>
            </form>
        </div>

        <div id="dishes_opt" class="tabcontent">
            <?php if (isset($_SESSION['username']) && isRestaurantOwner(intval($restaurantInfo['id']), $_SESSION['username'])) { ?>
                <div class="tabcontenteditbuttons">
                    <button class="editbuttons" onclick="switchEditAbout('dishes_opt','edit_dishes_opt')">Edit Dishes</button>
                </div>
            <?php } ?>
            <?php foreach ($dishes as $dish) { ?>
                <div class="menu_item" data-id="<?= $dish['name'] ?>">
                    <img src="images/dishes/<?= $dish['photo'] ?>.jpg">
                    <div id="dish_info">
                        <a href="../dish.php?name=<?= $dish['name'] ?>&photo=<?= $dish['photo'] ?>">
                            <h3><?= $dish['name'] ?></h3>
                        </a>
                        <p class="price"><?= $dish['price'] ?></p>
                        <p><?= $dish['category'] ?></p>
                    </div>
                    <?php if (isset($_SESSION['username']) && !isRestaurantOwner(intval($restaurantInfo['id']), $_SESSION['username'])) { ?>
                        <button id="add_to_cart_button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                            </svg>
                        </button>
                        <input name="text" class="text-order">
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <div id="edit_dishes_opt" class="tabcontent">
            <?php if (isset($_SESSION['username']) && isRestaurantOwner(intval($restaurantInfo['id']), $_SESSION['username'])) { ?>
                <div class="tabcontenteditbuttons">
                    <button class="editbuttons" onclick="switchEditAbout('edit_dishes_opt', 'dishes_opt')">Done</button>
                </div>
            <?php } ?>
            <?php foreach ($dishes as $dish) { ?>
                <div class="menu_item" data-id="<?= $dish['name'] ?>">
                    <img src="images/dishes/<?= $dish['photo'] ?>.jpg">
                    <form id="dish_info">
                        <input name="name" placeholder="<?= $dish['name'] ?>" type="text" value="<?= $dish['name'] ?>" readonly>
                        <input name="price" placeholder="<?= $dish['price'] ?>" type="text" value="<?= $dish['price'] ?>">
                        <input name="category" placeholder="<?= $dish['category'] ?>" type="text" value="<?= $dish['category'] ?>" readonly>
                        <input name="restaurant" type="hidden" value="<?= $restaurantInfo['id'] ?>">
                        <button id="delete_dish_button" formaction="actions/action_delete_dish.php" formmethod="post" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                            </svg>
                        </button>
                        <button id="edit_dish_info_button" formaction="actions/action_edit_dishes_price.php" formmethod="post" type="submit">
                            <i class="material-icons">done</i>
                        </button>
                    </form>
                </div>
            <?php } ?>
            <div class="menu_item">
                <button id="add_new_dish" onclick="document.getElementById('id02').style.display='block'">
                    <i class="material-icons">add_circle</i>
                </button>
            </div>
            <div id="id02" class="modal">
                <div id="add_forms">
                    <h1>Add Dish</h1>
                    <form action="actions/action_add_dish_menu.php" method="post" enctype="multipart/form-data">
                        <select name="dish">
                            <?php foreach ($alldishes as $dish) { ?>
                                <option value=<?= $dish['photo'] ?>><?= $dish['name'] ?></option>
                            <?php } ?>
                        </select>
                        <input type="text" name="price" placeholder="Price" required />
                        <input name="restaurant" type="hidden" value="<?= $restaurantInfo['id'] ?>">
                        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="button">Cancel</button>
                        <button type="button" onclick="document.getElementById('id02').style.display='none'; document.getElementById('id03').style.display='block'" class="button">New Dish</button>
                        <button type="submit" onclick="document.getElementById('id02').style.display='none'" class="button">Add</button>
                    </form>
                </div>
            </div>
            <div id="id03" class="modal">
                <div id="add_forms">
                    <form action="actions/action_add_dish.php" method="post" enctype="multipart/form-data">
                        <h1>New Dish</h1>
                        <input placeholder="Name" type="text" name="name">
                        <input placeholder="Category" type="text" name="category">
                        <input placeholder="Price" type="text" name="price">
                        <input placeholder="Image" type="file" name="image" id="image">
                        <input name="photo" type="hidden" value="<?= count($alldishes) + 1 ?>">
                        <input name="restaurant" type="hidden" value="<?= $restaurantInfo['id'] ?>">
                        <button type="button" onclick="document.getElementById('id03').style.display='none'" class="button">Cancel</button>
                        <button type="submit" onclick="document.getElementById('id03').style.display='none'" class="button">Add</button>
                    </form>
                </div>
            </div>
        </div>
        <div id="reviews_opt" class="tabcontent">
            <?php foreach ($reviews as $review) { ?>
                <div class="review_item">
                    <header>
                        <p><?= $review['customer'] ?></p>
                        <p><?php echo $date = date('F j', intval($review['date'])); ?></p>
                    </header>
                    <div class="review_content">
                        <p><?= $review['content'] ?></p>
                        <span>
                            <?php for ($i = 0; $i < $review['rating']; $i++) echo '<i class="material-icons checked">star</i>';
                            for ($i = 0; $i < 5 - $review['rating']; $i++) echo '<i class="material-icons">star</i>';
                            ?>
                        </span>
                    </div>
                    <?php if ($review['comment'] != "") { ?>
                        <div class="review_owner_answer">
                            <p>
                            <p id="hd_tt">Owner Answer: </p>
                            <p><?= $review['comment'] ?></p>
                            </p>
                        </div>
                        <?php } else {
                        if (isset($_SESSION['username']) && isRestaurantOwner(intval($restaurantInfo['id']), $_SESSION['username'])) { ?>
                            <button id="add_comment_to_review" onclick="document.getElementById('rev_<?= $review['id'] ?>').style.display='flex'"><i class="material-icons">comment</i></button>
                    <?php }
                    } ?>
                    <?php if (isset($_SESSION['username']) && ($_SESSION['username'] == $review['customer'])) { ?>
                        <form id="review_info" action="actions/action_delete_review.php" method="post">
                            <input name="id" type="hidden" value="<?= $review['id'] ?>">
                            <button id="delete_review">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg>
                            </button>
                        </form>
                    <?php } ?>
                </div>
                <div id="rev_<?= $review['id'] ?>" class="add_comment_to_review_box" >
                    <form action="actions/action_add_comment.php" method="post">
                        <input name="review" type="hidden" value="<?= $review['id'] ?>">
                        <textarea id="comment_content" name="content" placeholder="Comment ..." type="text"></textarea>
                    <button type = "submit" class="editbuttons"><i class="material-icons">done</i></button>
                    <button class="editbuttons" onclick="document.getElementById('rev_<?= $review['id'] ?>').style.display='none'"><i class="material-icons">close</i></button>
                    </form>
                </div>
            <?php } ?>
            <?php if (isset($_SESSION['username']) && $_SESSION['username'] != $restaurantInfo['owner']) { ?>
                <form class="add_review_box" action="actions/action_add_review.php" method="post">
                    <input name="customer" type="hidden" value="<?= $_SESSION['username'] ?>">
                    <input name="restaurant" type="hidden" value="<?= $restaurantInfo['id'] ?>">
                    <textarea id="new_review_content" name="review_content" placeholder="Add a review ..." type="text"></textarea>
                    <div>Rating: <input id="new_review_rating" type="number" name="review_rating" value="1" max="5" min="1" step="1">
                        <button type="submit" class="editbuttons">Post</button>
                    </div>
                </form>
            <?php } ?>
        </div>
        <div id="about_opt" class="tabcontent">
            <?php if (isset($_SESSION['username']) && isRestaurantOwner(intval($restaurantInfo['id']), $_SESSION['username'])) { ?>
                <div class="tabcontenteditbuttons">
                    <button class="editbuttons" onclick="switchEditAbout('about_opt','edit_about_opt')">Edit Infomation</button>
                </div>
            <?php } ?>
            <div id="about_item">
                <h3>Adress: </h3>
                <p><?= $restaurantInfo['adress'] ?></p>
            </div>
            <div id="about_item">
                <h3>Category: </h3>
                <p><?= $restaurantInfo['category'] ?></p>
            </div>
            <div id="about_item">
                <h3>Owner: </h3>
                <p><?= $restaurantInfo['owner'] ?></p>
            </div>
            <div class="mapouter">
                <div class="gmap_canvas"><iframe width="400" height="250" id="gmap_canvas" src="https://maps.google.com/maps?q=<?= $restaurantInfo['latitude'] . ',' . $restaurantInfo['longitude'] ?>&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://fmovies-online.net"></a><br>
                    <style>
                        .mapouter {
                            position: relative;
                            text-align: right;
                            height: 250px;
                            width: 400px;
                        }
                    </style><a href="https://www.embedgooglemap.net">embedgooglemap.net</a>
                    <style>
                        .gmap_canvas {
                            overflow: hidden;
                            background: none !important;
                            height: 500px;
                            width: 600px;
                        }
                    </style>
                </div>
            </div>
        </div>
        <div id="edit_about_opt" class="tabcontent">
            <?php if (isset($_SESSION['username']) && isRestaurantOwner(intval($restaurantInfo['id']), $_SESSION['username'])) { ?>
                <div class="tabcontenteditbuttons">
                    <button class="editbuttons" onclick="switchEditAbout('edit_about_opt', 'about_opt')">Cancel</button>
                    <button form="edit_rest_info" class="editbuttons" type="submit">Confirm</button>
                </div>
            <?php } ?>
            <form id="edit_rest_info" action="actions/action_edit_restaurant_info.php" method="post">
                <input name="id" type="hidden" value="<?= $restaurantInfo['id'] ?>">
                <div id="about_item">
                    <h3>Adress: </h3><input name="adress" placeholder="<?= $restaurantInfo['adress'] ?>" type="text" value="<?= $restaurantInfo['adress'] ?>">
                </div>
                <div id="about_item">
                    <h3>Category: </h3><input name="category" placeholder="<?= $restaurantInfo['category'] ?>" type="text" value="<?= $restaurantInfo['category'] ?>">
                </div>
            </form>
        </div>
        <div id="orders_opt" class="tabcontent">
            <div class="order_state_box">
                <header>
                    <h3>Received</h3>
                </header>
                <div class="order_state_box_content">
                    <?php foreach ($received as $order) { ?>
                        <div class="order">
                            <header>
                                <button id="dropdown_order_btn" onclick="if (document.getElementById('order_<?= $order['id'] ?>').style.display === 'block') {document.getElementById('order_<?= $order['id'] ?>').style.display = 'none';} else {document.getElementById('order_<?= $order['id'] ?>').style.display = 'block';}"><i class="material-icons">expand_more</i></button>
                                <p>
                                <p id="ord_hd_tt">Customer: </p>
                                <p><?= $order['customer'] ?></p>
                                </p>
                                <p>
                                <p id="ord_hd_tt">Total price: </p>
                                <p class="price"><?= $order['price'] ?></p>
                                </p>
                                <p>
                                <p id="ord_hd_tt">Date: </p>
                                <p><?php echo $date = date('F j', intval($order['date'])); ?></p>
                                </p>
                                <form action="actions/action_order_to_preparing.php" method="post" >
                                    <input name="orderid" type="hidden" value="<?= $order['id']?>">
                                    <button type="submit" class="change_state">
                                        <p>Preparing</p><i class="material-icons">sync_alt</i>
                                    </button>
                                </form>
                            </header>
                            <div id="order_<?= $order['id'] ?>" class="dropdown_content">
                                <?php foreach ($order['dishes'] as $dish) { ?>
                                    <div class="dropdown_content_item">
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
                                <p id="ord_hd_tt">Customer: </p>
                                <p><?= $order['customer'] ?></p>
                                </p>
                                <p>
                                <p id="ord_hd_tt">Total price: </p>
                                <p class="price"><?= $order['price'] ?></p>
                                </p>
                                <p>
                                <p id="ord_hd_tt">Date: </p>
                                <p><?php echo $date = date('F j', intval($order['date'])); ?></p>
                                </p>
                                <form action="actions/action_order_to_deliver.php" method="post" >
                                    <input name="orderid" type="hidden" value="<?= $order['id']?>">
                                    <button type="submit" class="change_state">
                                        <p>Delivered</p><i class="material-icons">sync_alt</i>
                                    </button>
                                </form>
                            </header>
                            <div id="order_<?= $order['id'] ?>" class="dropdown_content">
                                <?php foreach ($order['dishes'] as $dish) { ?>
                                    <div class="dropdown_content_item">
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
                                <p id="ord_hd_tt">Customer: </p>
                                <p><?= $order['customer'] ?></p>
                                </p>
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
    </section>
<?php } ?>