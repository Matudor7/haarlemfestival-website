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
    </div><br>
    
    <div>
        <div class="row">
            <div class="box-sizing-border-box"style="position:absolute; margin-top: 200px; right: 75px; z-index: -1">
            <img class="box-sizing-border-box" src="/media/yummyPics/details_stripes.png" alt="detail stripes">
            </div>
            <div class="col" style="margin-left: 2%">
                <img src="/media/yummyPics/detailimg_1.png" alt="..."/>
            </div>
            <div class="col" style="margin-right: 2%">
                <img src="/media/yummyPics/detailimg_2.png" alt="..."/><br><br>
                <div class="scrollable" style="height: 100%; overflow: auto; display: flex; justify-content: center; align-items: center;">
                    <button style="background-color:#EC5F41; color:#000000; border-radius:20px; font-size:20px; position: fixed; top: 90%; right: 30px;">Make a Reservation</button>
                </div>
            </div>
            <div class="col">
                <img src="/media/yummyPics/detailimg_3.png" alt="..."/>
            </div>

        </div>
    </div><br><br>
    <div>
        <div class="m-5" style="text-align: center;">
            <h1 style="text-align: center; border-right: 10px; border-left: 50px;">About us</h1><br><br>
            <div style="background: #09B4BB; height: auto;">
                <div style="padding: 30px; font-size: 18px; text-align: left; padding-left: 30px; padding-right: 30px;" >
                <p>Spectacle in a unique World Restaurant centrally located in the heart of Haarlem. With a special covered courtyard and a terrace with a view of the historic Vleeshal and the century-old Bavo church. In the world kitchen, works of art are created that stimulate every sense.</p>
                    <p>Specktakel is all about the experience, an experience that we create together, each in his or her own role. The world wines are carefully selected so that the wine is in harmony with the aromas and spices of the dish.The colours, aromas and flavors create a wonderful interplay that can be talked about…</p>
                    <p>We look forward to see you.<br>
                   Team Spectacle</p>
                   <p style="text-align: right"><strong> Type of food: </strong> </p>
                </div>
            </div><br><br>
        </div>
    </div>
    <div>
        <div class="m-5" style="text-align: center;">
            <h1 style="text-align: center; border-right: 10px; border-left: 50px;">Menu</h1><br><br>
            <div style="background: #09B4BB; height: auto;">
                <div style="padding: 30px; font-size: 18px; text-align: left; padding-left: 30px; padding-right: 30px;" >
                    <p>
                        At Specktakel we cook with worldly and honest ingredients. Everything comes from our own kitchen, we take animals and nature into account. Our menu changes every quarter based on available seasonal ingredients. We also serve frequently changing surprise menus based on the 5th flavor UMAMI…</p>
                    <p><strong>Kids menu: </strong> &#x20AC; add the price here<br>
                    <p><strong>Adults menu: </strong> &#x20AC; add the price here<br></p>
                    <p style="text-align: right"> stars image  </p>
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
                        <p>From July 27th to July 31st, We are offering 3 sessions of 1,5 hours each choose yours and reserve it now!</p>
                        <div class="container text-center">
                            <div class="row">
                                <div class="col">
                                   <strong>1st time slot</strong>
                                </div>
                                <div class="col">
                                    <strong>2nd time slot</strong>
                                </div>
                                <div class="col">
                                    <strong> 3rd time slot</strong>

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
                        <p> address: address goes here</p>
                        <p> Tel: tel goes here</p>
                        <p> email: email goes here</p>
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