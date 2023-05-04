<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shared Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <button class="btn btn-primary" type="button" onclick="window.location.href = '/' "><- Homepage</button>
    <h1>Shared Cart of <?php echo (is_null($sharedCartUser)) ? "Visitor" : $sharedCartUser->getUserFirstName()?></h1>
    <?php for($i = 0; $i < count($merged_products); $i++)
        {?>
            <div id ="productdiv <?php echo $i?>" style="display: flex; justify-content: space-between; align-items: center; margin-right: 50%">
                <div>
                    <h3 id="productamount <?php echo $i?>" style=""><?php echo $amounts[$i]?></h3>
                </div>
                <div style="margin-left: 20px">
                    <h2><?php echo $merged_products[$i]->getName()?></h2>
                    <h6><?php echo $merged_products[$i]->getLocation()?></h6>
                    <p><?php echo $merged_products[$i]->getStartTime()?></p>
                    <p><?php echo $information[$i]?></p>
                </div>
                <div>
                    <h3 id="productprice <?php echo $i?>">&euro;<?php echo ($merged_products[$i]->getPrice() * $amounts[$i])?></h3>
                </div>
            </div>
            <br>
        <?php
        }?>
</body>
</html>