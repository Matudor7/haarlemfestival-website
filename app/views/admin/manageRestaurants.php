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
<<br><br>
    <h2> Manage Restaurants</h2>
</div>
<div class="album py-5 bg-light">
    <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            foreach ($restaurants as $restaurant) {
                ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <a href="Yummy/detail?restaurant_id=<?=$restaurant->getRestaurantId()?>" > <img class="productPictures" style="width: 100%;" src="<?php echo$restaurant->getRestaurantPictureURL()?>"
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="350" xmlns="http://www.w3.org/2000/svg"
                                 role="img" aria-label="Placeholder: Hair cut" preserveAspectRatio=" xMidYMid slice" focusable="false">
                        </a>
                        <div  style="background: #09B4BB;text-align: center; color:white;" class="card-body">
                            <h4><?=$restaurant->getRestaurantName()?> </h4>
                            <p><?php echo $restaurant->displayImageBasedOnEnum($restaurant->getRestaurantRating())?></p>
                            <p class="card-text" > </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Add</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Delete</button>
                                </div>
                                <small class="text-muted"><strong><?=$restaurant->getFoodTypeName()?> </strong></small>
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