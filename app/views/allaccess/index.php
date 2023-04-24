<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Walking Tour</title>

    <link rel="stylesheet" href="/stylesheet.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</head>
<body>
<?php
include __DIR__ . '/../nav.php';
?>
<main>
    <div id="titleSection" class="text-center">
        <h1>All-Access Passes</h1>
        <h3>You can have it all!</h3>
    </div>


    <img id="mainPageImage" src="/media/allaccessPics/allaccessTickets.png">
    <div id="text-container" class="container bg-light opacity-75 text-center">
        <p class="text-center mt-1">Forget about planning and reservations! with an All-Access Pass you just have to worry about showing up and enjoy what The Festival has to offer!<br><br>
            Are you also excited?</p>
    </div>
    <div id="buttongroup">
    <button id="dayPassBtn" class="rounded-pill">Get Day Pass</button>
    <button id="unlimitedPassBtn" class="rounded-pill">Get Unlimited Pass</button>
    </div>
</main>
<?php
include __DIR__ . '/../footer.php';
?>
</body>
</html>
<style>
    body{
        background-color: #B9CFE2;
    }

    main{
        position: relative;
        z-index: 1;
        height: 500px;
    }
    #titleSection{
        margin-top: 10px;
    }
    #mainPageImage{
        position: absolute;
        top: 17%;
        left: 12%;
        max-width: 450px;
        max-height: 380px;
        z-index: 2;
    }
    #text-container{
        position: absolute;
        top: 33%;
        left: 50%;
        z-index: 2;
        max-width: 450px;
    }
    button{
        padding: 10px;
        font-weight: bold;
        margin-left: 15px;
    }
    #buttongroup{
        position: absolute;
        top: 66%;
        left: 56%;
        z-index: 2;
    }
    button:hover{
        background-color: white;
        border-color: #8564CC;
        color: #8564CC;
    }
    #titleSection h3{
        margin-top: 0px;
    }
    #titleSection h1{
        margin-bottom: 1px;
    }
</style>
