<?php declare(strict_types = 1);?>
<?php function output_dishes_page(array $dishes) { ?>
    <section class="dishes_page">
        <header>
            <input id="searchdish" type="text" placeholder="Search">
        </header>
        <div class="dishes_box">
            <?php foreach ($dishes as $dish) {?>
                <div class="carouselbox_item">
                    <a href="dish.php?name=<?=$dish['name']?>&photo=<?=$dish['photo']?>">
                        <h3><?=$dish['name']?></h3>
                        <img src="images/dishes/<?= $dish['photo']?>.jpg">
                    </a>
                </div>
            <?php } ?>
        </div>
    </section>
<?php } ?>

<?php function output_dish(array $dishInfo, array $restaurants, bool $favourite) { ?>
    <section class="dish_info_page">
        <header>
            <h2><?=$dishInfo['name']?></h2>
            <?php if (isset($_SESSION['username'])) {?>
                <div class="fav_icon" id="<?=$dishInfo['name']?>" <?php if($favourite){echo "hidden";}?>>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                    </svg>
                </div>
                <div class="fav_icon_selected" id="<?=$dishInfo['name']?>" <?php if(!$favourite){echo "hidden";}?>>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="yellow" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                    </svg>
                </div>
            <?php } ?>
            <img src="images/dishes/<?= $dishInfo['photo']?>.jpg">
        </header>
        <div class="tab">
            <button class="tablinks" onclick="openOpt(event, 'rest_available_opt')" id="defaultOpen">Restaurants Available</button>
        </div>
        <div id="rest_available_opt" class="tabcontent">
            <?php foreach ($restaurants as $restaurant) {?>
                <div class="menu_item" data-id="<?=$dishInfo['name']?>">
                    <div id="dish_info">
                        <a href="../restaurant.php?id=<?=$restaurant['id']?>"><h3><?=$restaurant['name']?></h3></a>
                        <p class="price"><?=$restaurant['price']?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
<?php } ?>