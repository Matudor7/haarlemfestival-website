<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All-Access Passes</title>

    <link rel="stylesheet" href="/stylesheet.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</head>
<body>
<?php
include __DIR__ . '/../nav.php';
?>
<main id="main">
    <div id="titleSection" class="text-center">
        <h1 id="title"><?php echo $this->getAllAccessContent('title')?></h1>
        <h3 id="subtitle"><?php echo $this->getAllAccessContent('subtitle')?></h3>
    </div>


    <img id="mainPageImage" src="<?php echo $this->getAllAccessContent('mainPageImage')?>">
    <div id="text-container" class="container bg-light opacity-75 text-center">
        <p id="generalDescription" class="mt-1"><?php echo $this->getAllAccessContent('generalDescription')?></p>

        <p id="typesDescription"><?php echo $this->getAllAccessContent('typesDescription')?></p>
    </div>
    <button id="buyTicketBtn" class="rounded-pill" onclick="openTicketForm()"><?php echo $this->getAllAccessContent('buyTicketBtn')?></button>
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
        top: 15%;
        left: 12%;
        max-width: 450px;
        max-height: 380px;
        z-index: 2;
    }
    #text-container{
        position: absolute;
        top: 25%;
        left: 50%;
        z-index: 2;
        max-width: 450px;
    }
    main button{
        position: absolute;
        top: 68%;
        left: 62%;
        z-index: 2;
        padding: 10px;
        font-weight: bold;
    }
    main button:hover{
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
