<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Oops!</title>

    <link rel="stylesheet" href="/stylesheet.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</head>
<body>
<body>
<?php
include __DIR__ . '/nav.php';
?>
<main id="main">
    <div id="titleSection" class="mt-5 text-center">
        <h1 id="title">Oops!</h1>
        <h3 class="m-2" id="subtitle">Something Happened</h3>
    </div>
    <img id="errorPageImage" src="/media/something-went-wrong.png">
    <div id="text-container" class="container text-center">
        <p id="generalDescription" class="mt-1">Sorry for the inconvenience, but it seems our festival gremlins are up to some mischief!<br>
        <br>Don't worry, though. While we fix the issue, there are plenty of amazing things to enjoy in our Festival! So why not take a break, explore the events, and have a great time!</p>
        <button id="returnHomeBtn" class="m-3 p-2 rounded-pill" onclick="window.location.href='/';">Return To Homepage</button>
        <p id="errorText" class="fw-bold"> <?php echo $error ?> </p>
    </div>
</main>

<?php
include __DIR__ . '/footer.php';
?>

<script>
    function onPageLoad() {
        console.log("<?php echo isset($error) ? $error : ''; ?>"); //logging the error to the console
    }
    window.onload = onPageLoad;
</script>

</body>
</html>

<style>
    body{
        background-color: #ffffff;
    }

    main{
        position: relative;
        z-index: 1;
        height: 500px;
    }
    #titleSection{
        margin-top: 10px;
    }
    #errorPageImage{
        position: absolute;
        top: 15%;
        left: 25%;
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
    #titleSection h3{
        margin-top: 0px;
    }
    #returnHomeBtn{
        background-color: #81d1f4;
        border-color: #2f8ace;
        
    }
    #titleSection h1{
        margin-bottom: 1px;
    }
    #errorText{
        color: red;
    }
</style>