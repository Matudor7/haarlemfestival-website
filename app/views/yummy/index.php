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
            <div class="col">
                <div class="card shadow-sm">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                    <div  style="background: #09B4BB;text-align: center; color:white;" class="card-body">
                        <p class="card-text" >This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                            </div>
                            <small class="text-muted">9 mins</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div  id="recipesToCookHome">
    <div  style=" height: 100px;  border-color: #EC5F41;border-width 10px; text-align: center; color:black; " class="card-body">
        <h2 class="card-text" style="padding-bottom: 30px; padding-top: 30px;text-align: center;"><strong>I know that you are excited and can’t wait any longer to try some tasty food, that is why we are offering you some recipes to be cooked at home</strong></h2>
    </div>
</div>

<?php
include __DIR__ . '/../footer.php';
?>
</body>
</html>