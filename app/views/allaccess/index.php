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
<main class="text-center">
    <div id="titleSection" class="mt-4">
        <h1>All-Access Passes</h1>
        <h3>You can have it all!</h3>
    </div>


    <img src="/media/allaccessPics/allaccessTickets.png">
    <div id="text-background">
        <p class="text-center">Forget about planning and reservations! with an All-Access Pass you just have to worry about showing up and enjoy what The Festival has to offer!<br><br>
            Are you also excited?</p>
    </div>
    <button id="dayPassBtn" class="rounded-pill">Get Day Pass</button>
    <button id="unlimitedPassBtn" class="rounded-pill">Get Unlimited Pass</button>
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
</style>
