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
        <h1 class="text-center py-3" style="color: black">Event name</h1>
    </div>
    
    <div>
        <div class="row">
            <div class="box-sizing-border-box"style="position:absolute; margin-top: 200px; right: 75px; z-index: -1">
            <img class="box-sizing-border-box" src="/media/yummyPics/details_stripes.png" alt="detail stripes">
            </div>
            <div class="col" style="margin-left: 2%">
                <img src="/media/yummyPics/detailimg_1.png" alt="..."/>
            </div>
            <div class="col" style="margin-right: 2%">
                <img src="/media/yummyPics/detailimg_2.png" alt="..."/>
            </div>
            <div class="col">
                <img src="/media/yummyPics/detailimg_3.png" alt="..."/>
            </div>
        </div>
    </div>

    <?php
    require __DIR__ . '/../footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>