
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


    <main id="main">
<section id="header-container" class="container mx-0 px-0">
<img src="/media/walkingtourPics/walkingtourHeader.png" class="img-fluid" alt="Header" id="header-img">
<div id="text-container" class="container bg-light w-50 opacity-75 text-center">
<p id="header-text" class="text-dark"><?php echo $this->getContent('Header')->getText()?></p>
</div>
<button id="header-button-show" class="rounded-pill">Show me around</button>
<button id="header-button-program" class="rounded-pill" onClick="openTicketForm()"><?php echo $this->getContent('Header')->getButtonText()?></button>
</section>

<div class="container pt-5 text-center" >
  <img src="/media/walkingtourPics/walking-tour-title-logo.png" class="" id="title-logo">
  <div class="container text-center">
    <div class="row pt-4">
  <div class="col" id="description-left">
    <h5><?php echo $this->getContent('Description-Left')->getTitle()?></h5>
  <p><?php echo $this->getContent('Description-Left')->getText()?></p>
  <button class="rounded-pill"><?php echo $this->getContent('description-left')->getButtonText()?></button>
</div>
  <div id="map-container" class="col">
       <img id="map-placeholder" src="/media/walkingtourPics/mapplaceholder.png" class="" alt="map">
  </div>
  <div class="col" id="description-right">
  <p><?php echo $this->getContent('Description-Right')->getText()?></p>
  <button class="rounded-pill"><?php echo $this->getContent('Description-Right')->getButtonText()?></button>
</div>
</div>
<div class="row pt-4">
  <div class="col" id="text-container-left">
    <h5><?php echo $this->getContent('Container-Left')->getTitle()?></h5>
  <ul><?php echo $this->getContent('Container-Left')->getText()?></ul>
</div>
<div class="col" id="text-container-right">
    <h5><?php echo $this->getContent('Container-Right')->getTitle()?></h5>
    <p><?php echo $this->getContent('Container-Right')->getText()?></p>
    <br>

    <div class="container text-center">
        <div class="row">
            <?php foreach ($prices as $price ) { ?>
                <div class="col">
                    <h6><?php echo $price->getDescription()?></h6>
                    <p class="mb-0"><?php echo $price->getPrice()?></p>
                    <label>for <?php echo $price->getAmountofPeople()?> pax</label>
                </div>
            <?php } ?>
    </div>
        
        <button class="rounded-pill" onClick="openTicketForm()"><?php echo $this->getContent('Container-Right')->getButtonText()?></button>
    </div>
</div>
</div>

<div class="row pt-4">
    <div id="locations-text-container" class="container text-center">
        <h3><?php echo $this->getContent('Locations-Container')->getTitle()?></h3>
        <div class="row">
        <div id="locations-map-container" class="col">
       <img id="map-placeholder" src="/media/walkingtourPics/mapplaceholder.png" class="" alt="map">
        </div>
            <div class="col">
                <p><?php echo $this->getContent('Locations-Container')->getText()?></p>
                <br>
                <ol>
                    <?php foreach ($locations as $location) { ?>
                        <li><a href="#"><?php echo $location->getLocationName()?></a></li><?php } ?>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row pt-4">
    <div id="timetable-text-container" class="container text-center">
        <h3><?php echo $this->getContent('Timetables-Container')->getTitle()?></h3>
        <p><?php echo $this->getContent('Timetables-Container')->getText()?></p>
<table id="timetable-table" class="table table-bordered border-dark">
  <thead>
    <th scope="col" class="border border-dark border-4">Date</th>
    <th scope="col" class="border border-dark border-4">Time</th>
    <?php foreach ($languages as $language) {?>
    <th scope="col" class="border border-dark border-4"><?php echo $language->getTourLanguage()?></th>
  <?php } ?>
    <th scope="col" class="border border-dark border-4">Spots</th>
  </thead>
  <tbody class="border border-botttom-0 border-start-0 border-4 border-dark">
        <?php
        foreach ($timetables as $timetable) {
            $date = $timetable->getTimetableStartDate()->format(' D dS / M');

            if (!isset($timetablesByDate[$date])) {
                $timetablesByDate[$date] = array();
            }
            $timetablesByDate[$date][] = $timetable;
        }

        foreach ($timetablesByDate as $date => $timetables) {
        ?>
    <tr>
        <th scope="row" class="border border-dark border-4 border-top-0"><?php echo $date?></th>

      <td class="p-0">
        <table class="table p-0 m-0">
            <?php
            // Loop through the timetables for the current date
            foreach ($timetables as $timetable) {
                ?>
                <tr class="border border-2 border-dark border-top-0 border-start-0 border-end-0">
                    <td><?php echo $timetable->getTimetableStartTime()->format('H:i'); ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
      </td>
        <?php foreach ($languages as $language) { ?>
            <td class="p-0">
                <table class="table my-0">
                    <?php
                    foreach ($timetables as $timetable) {
                        $count = 0;
                        $found_tour = false;

                        foreach ($walkingTours as $walkingTour) {
                            if ($walkingTour->getTourLanguage() == $language) {
                                if ($walkingTour->getTourTimetable()->getTimetableStartDate() == $timetable->getTimetableStartDate()) {
                                    if ($walkingTour->getTourTimetable()->getTimetableStartTime() == $timetable->getTimetableStartTime()) {
                                        $count++;
                                        $found_tour = true;
                                    }
                                }
                            }
                        }

                        if ($found_tour) {
                            ?>
                            <tr class="border border-2 border-dark border-top-0 border-start-0 border-end-0">
                                <td><?php echo $count ?></td>
                            </tr>
                            <?php
                        } else {
                            ?>
                            <tr class="border border-2 border-dark border-top-0 border-start-0 border-end-0">
                                <td>0</td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </td>
        <?php } ?>
<td class="p-0"><table class="table p-0 m-0">
        <?php $index=0; foreach ($timetables as $timetable){?>
            <tr class="border border-2 border-dark border-top-0 border-start-0 border-end-0">
            <td><?php echo $walkingTours[$index]->getTourCapacity()?></td>
            </tr><?php $index++; } ?>
    </table></td>
    </tr>
  <?php }?>
  </tbody>
</table>


</div>
</div>

      <?php foreach ($allContent as $content){
          if ($content->getIsCreated()){?>
      <div id="<?php echo $content->getSection()?> "class="container text-center newSectionContainer">
          <h3><?php echo $content->getTitle()?></h3>
          <p><?php echo $content->getText()?></p>
          <br>
          <button class="rounded-pill" href="#"><?php echo $content->getButtonText()?></button>

      </div>
      <?php }} ?>

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
    max-width: 1205px;
    z-index: 1;
    height: 100%;
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
    top: 75%;
    left: 40%;
    width: 220px;
    transform: translate(-50%, -50%);
    z-index: 2;
}


#header-button-program{
    position: absolute;
    width: 220px;
    top: 75%;
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
    max-width: 350px;
}
#description-right{
    padding-top: 20px;
}

#text-container-left{
    border: 4px solid #8564CC;
    padding: 10px;
    border-radius: 60px;
    margin: auto;
    max-width: 460px;
}

#text-container-right{
    border: 4px solid #8564CC;
    padding: 10px;
    border-radius: 60px;
    margin: auto;
    max-width: 460px;
}

label{
    font-size: 12px;
}

#locations-text-container{
    border: 4px solid #8564CC;
    padding: 10px;
    border-radius: 60px;
    max-width: 1000px;
}

#locations-map-container{
    border: 4px solid #8564CC;
    padding: 10px;
    border-radius: 60px;
    margin: 30px;
    max-width: 330px;
}

#timetable-text-container{
    border: 4px solid #8564CC;
    padding: 10px;
    max-width: 1000px;
    border-radius: 60px;
}

table{
    font-size: 14px;
    max-width: 550px;
    margin: auto;
}


.newSectionContainer{
    border: 4px solid #8564CC;
    padding: 20px;
    border-radius: 60px;
    max-width: 1000px;
    margin-left: 50px;
    margin-top: 20px;
}
</style>

