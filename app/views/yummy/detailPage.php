<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<?php
require __DIR__ . '/../nav.php';
?>
<div class="mt-5 mb-5 border-top" style="background: #09B4BB; margin-left: 30%; margin-right: 30%">
    <h1 class="text-center py-3" style="color: black"><?=$restaurant->getRestaurantName()?></h1>
</div><br>
<div- class="text-center">
    <?php
    if(isset($_SESSION['noDetailPageMessage'])){
        echo '<div class="alert alert-danger">' . $_SESSION['noDetailPageMessage'] . '</div>';
        unset($_SESSION['noDetailPageMessage']);
    }
    ?>
</div->
<div>
    <div class="row">
        <div class="box-sizing-border-box"style="position:absolute; margin-top: 200px; right: 75px; z-index: -1">
            <img class="box-sizing-border-box" src="/media/yummyPics/details_stripes.png" alt="detail stripes">
        </div>
        <div class="col">
            <img style="margin-left: 2%; max-height: 511px; max-width: 474px;" src="<?=$html->getDetailPic1URL()?>" alt="..."/>
        </div>
        <div class="col" ><br><br><br>
            <img style="margin-left: 2%; max-height: 511px; max-width: 474px;" src="<?=$html->getDetailPic2URL();?>" alt="..."/><br><br>
        </div>
        <div class="col" >
            <img style="margin-left: 2%; max-height: 511px; max-width: 474px;" src="<?=$html->getDetailPic3URL();?>" alt="..."/>
        </div>
    </div>


    <div class="scrollable" style="height: 100%; overflow: auto; display: flex; justify-content: center; align-items: center;">
        <button style="background-color:#EC5F41; color:#000000; border-radius:20px; font-size:20px; position: fixed; top: 90%; right: 30px;">Make a Reservation</button>
    </div>
</div><br><br>
<div>
    <div class="m-5" style="text-align: center;">
        <h1 style="text-align: center; border-right: 10px; border-left: 50px;">About us</h1><br><br>
        <div style="background: #09B4BB; height: auto;">
            <div style="padding: 30px; font-size: 18px; text-align: left; padding-left: 30px; padding-right: 30px;" >
                <?=$html->getAboutUs()?>
                <p style="text-align: right"><strong> Type of food: <?=$restaurant->getFoodTypeName()?> </strong> </p>
            </div>
        </div><br><br>
    </div>
</div>
<div>
    <div class="m-5" style="text-align: center;">
        <h1 style="text-align: center; border-right: 10px; border-left: 50px;">Menu</h1><br><br>
        <div style="background: #09B4BB; height: auto;">
            <div style="padding: 30px; font-size: 18px; text-align: left; padding-left: 30px; padding-right: 30px;" >
                <?=$html->getMenu()?>
                <p><strong>Kids menu: </strong> &#x20AC; <?=$restaurant->getRestaurantKidsPrice()?><br>
                <p><strong>Adults menu: </strong> &#x20AC; <?=$restaurant->getRestaurantAdultsPrice()?><br></p>
            </div>
        </div><br><br>
    </div>
</div>
<div class="container" style="padding: 40px;">
    <div class="row">
        <h1 style="align-items: center;">Time Slot</h1>
        <div class="col-6" style="padding: 5px; display: flex; align-items: center;">

            <div style="background: #09B4BB; height: auto;">
                <div style="padding: 30px; font-size: 18px; text-align: left; padding-left: 30px; padding-right: 30px;" >
                    <?=$html->getTimeSlotContent()?>
                    <div class="container text-center">
                        <div class="row">
                            <div class="col">
                                <strong><?php echo $restaurant->getTimeSlots()[0];?>pm</strong>
                            </div>
                            <div class="col">
                                <strong><?php echo $restaurant->getTimeSlots()[1];?>pm</strong>
                            </div>
                            <div class="col">
                                <strong> <?php echo $restaurant->getTimeSlots()[2];?>pm</strong>

                            </div>
                        </div>
                    </div>
                </div>
                <div style="text-align:center; padding-bottom: 10px;">
                    <button style="background-color:#EC5F41; color:#000000; border-radius:20px; font-size:20px; margin: 0 auto;">Make a Reservation</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="padding: 40px;">
    <div class="row">
        <h1 style="align-items: center;">Contact Inf</h1>
        <div class="col-6" style="padding: 5px; display: flex; align-items: center;">

            <div style="background: #09B4BB; height: auto;">
                <div style="padding: 30px; font-size: 18px; text-align: left; padding-left: 30px; padding-right: 30px;" >
                    <p><strong> Address:</strong> <?=$address->getAddressStreet()?> </p>
                    <p> Tel: <?=$contact->getTelephoneNumber()?> </p>
                    <p> email: <?=$contact->getEmail()?> </p>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
require __DIR__ . '/../footer.php';
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>