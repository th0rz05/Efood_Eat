<?php declare(strict_types = 1);?>
<?php function output_mainPage(array $restaurants, array $dishes) { ?>
<section class="top10list">
    <h2>Top 10 Restaurants</h2>
    <div class="carousel">
        <div class="carouselbox">
            <?php foreach ($restaurants as $restaurant) {?>
                <div class="carouselbox_item">
                    <a href="restaurant.php?id=<?=$restaurant['id']?>">
                        <h3><?=$restaurant['name']?></h3>
                        <img src="images/restaurants/<?= $restaurant['id']?>.jpg">
                    </a>
                </div>
            <?php } ?>
        </div>
        <button class="switchLeft sliderButton" onclick="sliderLeft(0)">&#10094</button>
        <button class="switchRight sliderButton" onclick="sliderRight(0)">&#10095</button>
    </div>
</section>

<section class="top10list">
    <h2>Top 10 Dishes</h2>
    <div class="carousel">
        <div class="carouselbox">
            <?php foreach ($dishes as $dish) {?>
                <div class="carouselbox_item">
                    <a href="dish.php?name=<?=$dish['name']?>&photo=<?=$dish['photo']?>">
                        <h3><?=$dish['name']?></h3>
                        <img src="images/dishes/<?= $dish['photo']?>.jpg">
                    </a>
                </div>
            <?php } ?>
        </div>
        <button class="switchLeft sliderButton" onclick="sliderLeft(1)">&#10094</a>
        <button class="switchRight sliderButton" onclick="sliderRight(1)">&#10095</a>
    </div>    
</section>

<?php } ?>