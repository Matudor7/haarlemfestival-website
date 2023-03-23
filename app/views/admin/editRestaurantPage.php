<!DOCTYPE html>
<html>
<!-- old-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/stylesheet.css" type="text/css">
    <link rel="stylesheet" href="/yummyStyle.css" type="text/css">
</head>
<body>
<?php
include __DIR__ . '/../nav.php';
?><br><br><br>
<h1 class="text-center">Edit Restaurant Page</h1><br><br>

<div class="text-center">
    <form action="/admin/editRestaurant" method="post">

        <label for="restaurant_name">Restaurant Name:</label>
        <input type="text" name="restaurant_name" id="restaurant_name">
        <br><br>
        <label for="restaurant_foodType">Food Type:</label>
        <select name="restaurant_foodType" id="restaurant_foodType">
            <?php foreach ($foodTypes as $foodtype){?>
                <option value="<?=$foodtype->getFoodTypeId()?>"><?=$foodtype->getFoodType()?></option>
            <?php }?>
        </select>
        <br><br>
        <label for="restaurant_rating">Rating:</label>
        <select name="restaurant_rating" id="restaurant_rating">
            <?php foreach ($ratings as $rating){?>
                <option value="<?=$rating->getRestaurantRatingId()?>"><?=$rating->getRatingNumber()?></option>
            <?php }?>
        </select>
        <br><br>
        <label for="restaurant_kidsPrice">Kids Price:</label>
        <input type="number" name="restaurant_kidsPrice" id="restaurant_kidsPrice" min="0" step="0.01">
        <br><br>

        <label for="restaurant_adultsPrice">Adults Price:</label>
        <input type="number" name="restaurant_adultsPrice" id="restaurant_adultsPrice" min="0" step="0.01">
        <br><br>
        <label for="duration">Duration:</label>
        <select name="duration" id="duration">
            <option value="01:00:00">1 hour</option>
            <option value="01:30:00">1 hour 30 minutes</option>
            <option value="02:00:00">2 hours</option>
            <option value="02:30:00">2 hours 30 minutes</option>
            <option value="03:00:00">3 hours</option>
        </select>
        <br><br>

        <label for="haveDetailPage">Have Detail Page:</label>
        <select name="haveDetailPage" id="haveDetailPage">
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select>
        <br><br>

        <label for="opening_time">Opening Time:</label>
        <input type="time" name="opening_time" id="opening_time">
        <br><br>

        <label for="time_slots">Number of Time Slots:</label>
        <input type="number" name="numTime_slots" id="numTime_slots" min="1" max="4">
        <br><br>
        <br>

        <label for="num_seats">Number of Seats:</label>
        <input type="number" name="num_seats" id="num_seats" min="1">
        <br><br>

        <label for="restaurant_pictureURL">Picture URL:</label>
        <input type="text" name="restaurant_pictureURL" id="restaurant_pictureURL">
        <br><br>

        <input type="submit" name="addRestaurant"  class="btn btn-success" value="Add Restaurant">
    </form>
</div>
</body>


<?php
include __DIR__ . '/../footer.php';
?>
</html>