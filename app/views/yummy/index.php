
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
<div class="d-flex">
    <img id="backgroundYummy" src="media/yummyPics/background.jpg" style="width: 100%;" alt="festivalYummyPic"/>
</div>
<div class="m-5" style="text-align: center;">
    <h1 id="myH1" style="text-align: center; border-right:  10px; border-left:  50px;">The 2022 summer edition of  Haarlem Food Festival will be held from Thursday July 27th to Monday July 31th at Grotemarkt </h1><br><br>
    <div style="background: #09B4BB; border-radius: 15px; height: 140px;" >
        <h2 style="padding-bottom: 30px; padding-top: 30px;text-align: center;"> “Your body is not a temple, it is an amusement park. Enjoy the ride.”
            <br>Anthony Bourdain</h2>
    </div><br><br>
    <h2> Check out the list of Restaurants participating in the event with reduced price</h2>
</div>
<div class="album py-5 bg-light">
    <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            foreach ($restaurants as $restaurant) {
                ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <a href="Yummy/detail?restaurant_id=<?=$restaurant->getRestaurantId()?>" > <img style="width: 100%; transform-origin: center; transition: transform 0.2s ease-in-out; cursor: pointer;" onmouseover="this.style.transform='scale(0.9)';" onmouseout="this.style.transform='scale(1)';"" src="<?php echo$restaurant->getRestaurantPictureURL()?>"
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="350" xmlns="http://www.w3.org/2000/svg"
                                 role="img" aria-label="Placeholder: Hair cut" preserveAspectRatio=" xMidYMid slice" focusable="false">
                        </a>
                        <div  style="background: #09B4BB;text-align: center; color:white;" class="card-body">
                            <h4><?=$restaurant->getRestaurantName()?> </h4>
                            <p><?php echo $restaurant->displayImageBasedOnEnum($restaurant->getRestaurantRating())?></p>
                            <p class="card-text" > </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" onClick="location.href='/Yummy/detail?restaurant_id=<?=$restaurant->getRestaurantId()?>'" class="btn btn-sm btn-outline-secondary">View</button>
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
<div  id="recipesToCookHome">
    <div style="padding-top: 30px; padding-right: 30px; padding-left: 30px;">
        <div style="border: thick solid  #EC5F41; height: 140px;">
            <h2 class="card-text" style="padding-bottom: 30px; padding-top: 30px; margin-left:  25px; margin-right 25px; text-align: center;"><strong>I know that you are excited and can’t wait any longer to try some tasty food, that is why we are offering you some recipes to be cooked at home</strong></h2>
        </div>
    </div>
</div>
<div class="container" style="padding: 40px;">
    <div class="row">
        <?php
        foreach ($recipes as $recipe) {
            ?>
            <div class="col-6" style="padding: 5px; border: thick solid #09B4BB; display: flex; align-items: center;">
                <div style="float: left; margin-right: 10px;">
                    <img src="<?php echo $recipe->getPictureURL(); ?>" style="border-radius: 50%; max-width: 300px;" class="img-rounded" alt="Your Image">
                </div>
                <div style="text-align: center;">
                    <h3 style="margin-top: 0;"><?php echo $recipe->getTitle(); ?></h3>
                    <p><?=$recipe->getType();?>,  <?=$recipe->getDuration();?> minutes</p>
                    <button>Subscribe</button>
                </div>
            </div>
        <?php }
        ?>
    </div>
</div>

<?php
include __DIR__ . '/../footer.php';
?>
</body>
</html>