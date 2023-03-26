<!DOCTYPE html>
<html>
<!-- old-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homepage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/stylesheet.css" type="text/css">
    <link rel="stylesheet" href="/yummyStyle.css" type="text/css">
</head>
<body>
<?php
include __DIR__ . '/../nav.php';
?>
<br><br>
<h2 style="text-align: center;"> Manage Restaurants</h2>
</div>
<div class="album py-5 bg-light">
    <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            foreach ($restaurants as $restaurant) {
                ?>
                <div class="col">
                    <div class="card shadow-sm">

                        <div   style="border: thick solid  #09B4BB;" class="card-body">
                            <h4 style="text-align: center;"><?=$restaurant->getRestaurantName()?> </h4><br>

                            <p><strong>General Information</strong></p>
                            <p> Type of Food: <?=$restaurant->getFoodTypeName()?> </p>
                            <p> Rating: <?=$restaurant->getRestaurantRating()?> stars </p>
                            <p>Number of available seats:  <?=$restaurant->getRestaurantNumberOfAvailableSeats()?><br></p>
                            <p>Have detail page:   <?=$restaurant->getDetailPageAsYesOrNoTxt()?><br></p><br>

                            <p><strong>Time Information</strong></p>
                            <p>Opening time:   <?=$restaurant->getRestaurantOpeningTime()?>pm<br></p>
                            <p>Number of Time Slots:   <?php echo $restaurant-> getNumberOfTimeSlots();?></p>
                            <p>Duration of Time Slots:   <?php echo $restaurant->getDuration();?></p><br>


                            <p><strong>Price</strong></p>
                            <p>Kids menu:  &#x20AC; <?=$restaurant->getRestaurantKidsPrice()?><br>
                            <p>Adults menu: &#x20AC; <?=$restaurant->getRestaurantAdultsPrice()?><br></p>

                            <div class="btn-group" style="text-align: right; margin-left: 10px;">
                                <button onclick="location.href='/admin/editRestaurantPage?id=<?=$restaurant->getRestaurantId()?>'"  type="button" class="btn btn-warning">Edit</button>
                                <button onclick="location.href='/admin/deleteRestaurantPage?id=<?=$restaurant->getRestaurantId()?>'"  type="button" class="btn btn-danger">Delete</button>
                            </div>
                            <div class="scrollable" style="height: 100%; overflow: auto; display: flex; justify-content: center; align-items: center;">
                                <button onclick="location.href='/admin/addRestaurantPage'" style="background-color:#14A44D; color:white; padding: 10px; border-radius:20px; font-size:20px; position: fixed; top: 90%; right: 30px; ">Add New Restaurant</button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php }
            ?>
        </div>
    </div>
</div>
<?php
include __DIR__ . '/../footer.php';
?>
</body>
</html>