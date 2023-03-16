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

<section id="header-container" class="container mx-0 px-0">
<img src="/media/walkingtourPics/walkingtourHeader.png" class="mx-auto" alt="Header" id="header-img">
<div id="text-container" class="container bg-light w-50 opacity-75 text-center">
<p id="header-text" class="text-dark"><?php echo $event->getDescription()?></p>
</div>
<button id="header-button-show" class="rounded-pill">Show me around</button>
<button id="header-button-program" class="rounded-pill">Save me a spot</button>
</section>

<div class="container pt-5 text-center">
  <img src="/media/walkingtourPics/walking-tour-title-logo.png" class="" id="title-logo">
  <div class="container text-center">
    <div class="row pt-4">
  <div class="col" id="description-left">
    <h5>From <?php echo $event->getStartTime()?> to <?php echo $event->getEndTime()?></h5>
  <p>There will be a walking tour with several departures each day, with different languages available; and overall duration of 2 and a half hours, including a 15mins break with refreshments.</p>
  <button class="rounded-pill">When?</button>
</div>
  <div id="map-container" class="col">
       <img id="map-placeholder" src="/media/walkingtourPics/mapplaceholder.png" class="" alt="map">
  </div>
  <div class="col" id="description-right">
  <p>With 9 landmarks to visit and multiple streets to walk through, you will have plenty memorable moments, starting from the Saint Bavo Church, your guide will submerge you on Haalem’s History.</p>
  <button class="rounded-pill">Where?</button>
</div>
</div>
<div class="row pt-4">
  <div class="col" id="text-container-left">
    <h5>worth knowing</h5>
  <ul>
    <li>The walking tour has a minimum age requirement of 12 years old.</li>
    <li>Time slots must be reserved in advance through our website.</li>
    <li>There are 12 people in each group for the tour, if you are bringing someone with you please reserve together.</li>
    <li>The tour is guided live in Dutch, English and Chinese, don’t forget to select your preferred language.</li>
    <li>All tours start from the  St. Bavo Cathedral.</li>
</ul>
</div>
<div class="col" id="text-container-right">
    <h5>Prices</h5>
    <p>In order to accomodate everyone, we are offering two different prices for our walking tour! the prices include one drink for each person and of course, an enjoyable experience.</p>
    <br>

    <div class="container text-center">
        <div class="row">
            <div class="col">
                <h6>regular ticket</h6>
                <p>regular price</p>
            </div>
            <div class="col">
                <h6>family ticket</h6>
                <p class="mb-0">family price</p>
                <label>max 4 people</label>
            </div>
    </div>
        
        <button class="rounded-pill">sing me up!</button>	
    </div>
</div>
</div>

<div class="row pt-4">
    <div class="container text center">
        <h3>Sites to See</h3>
        <div class="row">
        <div id="map-container" class="col">
       <img id="map-placeholder" src="/media/walkingtourPics/mapplaceholder.png" class="" alt="map">
        </div>
            <div class="col">
                <p>The guide will bring you to these 9 majestic Haarlem landmarks; starting with the Bavo Cathedraal</p>
            </div>
        </div>
    </div>
</div>

</main>


<?php
        include __DIR__ . '/../footer.php';
        ?>
    </body>
</html>
<style>


button {
    font-size: 21px;
    background-color: #8564CC;
    color: white;
    border-color: white;
    font-weight: 600;
    padding-left: 15px;
    padding-right: 15px;
    height: 40px;
    border-width: 3px;
}

button:hover{
    background-color: white;
    border-color: #8564CC;
    color: #8564CC;
}

#header-container{
    position: relative;
    background-color: white;
}
#header-img{
    position: relative;
    z-index: 1;
    width: 1204px;
    height: 100%;
    background-image: url("/media/walkingtourPics/walkingtourHeader.png");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

#text-container{
    position: absolute;
    top: 48%;
    left: 54%;
    transform: translate(-50%, -50%);
    font-size: 25px;
    z-index: 2;
}

#header-button-show{
    position: absolute;
    top: 70%;
    left: 40%;
    width: 220px;
    transform: translate(-50%, -50%);
    z-index: 2;
}


#header-button-program{
    position: absolute;
    width: 220px;
    top: 70%;
    left: 65%;
    transform: translate(-50%, -50%);
    z-index: 2;
}

#title-logo{
    width: 300px
}

#map-placeholder{
    width: 300px;
    height: 250px;
}

#map-container{
    border: 4px solid #8564CC;
    padding: 10px;
    border-radius: 60px;
}
#description-right{
    padding-top: 20px;
}

#text-container-left{
    border: 4px solid #8564CC;
    padding: 10px;
    border-radius: 60px;
    margin-right: 10px;
}

#text-container-right{
    border: 4px solid #8564CC;
    padding: 10px;
    border-radius: 60px;
    margin-left: 10px;
}

label{
    font-size: 12px;
}
</style>

