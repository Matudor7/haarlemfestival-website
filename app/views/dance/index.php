<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homepage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="/stylesheet.css" type="text/css">
</head>

<body>
    <?php
        include __DIR__ . '/../navfordance.php';
        ?>

    <main class="container-fluid">
        <div class="row mb-2">
            <div class="p-4 p-md-5 mb-4 ">
                <div class="col-md-6 px-0">
                    <h1 id="dance-header-title" class="display-4 fw-semibold">DANCE!</h1>
                    <h2 id="dance-header-description" class="lead my-3 fw-semibold text-light">Enjoy the world's best
                        DJs
                        perform in
                        Haarlem!</h2>
                    <button id="dance-button-learn-more" type="button"
                        class="btn btn-primary rounded-pill fw-bold">Learn More</button>
                    <button id="dance-button-buy-tickets" type="button"
                        class="btn btn-primary rounded-pill fw-bold ">Buy Tickets</button>
                </div>
            </div>

            <!--PARTICIPATING ARTISTS-->

            <div class="row mb-4">
                <div class="col">
                    <h5 id="dance-title-blue" class="mt-4 mr-0 p-1 fw-semibold text-center"> .... </h5>
                </div>
                <div class="col">
                    <h2 id="dance-title-light" class="display-6 ml-0 p-3 fw-semibold text-center text-dark">
                        Participating Artists</h2>
                </div>
                <div class="col"> </div>
                <div class="col"> </div>
            </div>

            <!-- 2 col artists-->
            <div class="row">
                <?php 
                foreach ($artists as $artist){
                    if($artist->getHasDetailPage() == 1){                
                ?>
                <div class="col-md-6">
                    <div id="dance-artist-card-light"
                        class="row g-0 border overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-light">
                        <img class="p-2 bd-placeholder-img card-img-top" src="<?php echo $artist->getArtistHomepageImageUrl()?>"
                            alt="<?php echo $artist->getName()?>'s photo">
                        <div class="col p-4 d-flex flex-column position-static">
                            <h3 class="mb-0 fw-bold text-dark"><?php echo $artist->getName()?></h3>
                            <p class="card-text mb-auto">ARTIST GENRE(s)</p>

                        </div>
                        <div class="col-auto p-4 d-none d-lg-block">
                            <button id="dance-artists-learn-more-button" type="button"
                                class="btn rounded-pill mb-auto fw-semibold text-dark">Learn More About the
                                Artist</button>
                        </div>
                    </div>
                </div>
                <?php }}
                ?>
            </div>
            <!-- 4 col artists WILL BE A PHP LOOP OF 4-->
            <div class="row">
                <?php 
                foreach ($artists as $artist){
                    if($artist->getHasDetailPage() == 0){                
                ?>
                <div class="col">
                    <div id="dance-artist-card-dark"
                        class="row g-0 border overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <img class="p-2 bd-placeholder-img card-img-top" src="<?php echo $artist->getArtistHomepageImageUrl()?>"
                            alt="<?php echo $artist->getName()?>'s photo">
                        <div class="col p-4 d-flex flex-column position-static">
                            <h3 class="mb-0 fw-bold text-light"><?php echo $artist->getName()?></h3>
                            <p class="card-text mb-auto text-light">ARTIST GENRE(s)</p>
                        </div>
                    </div>
                </div>
                <?php }}
                ?>
            </div>



            <!-- Locations Section -->
            <!-- Locations Title -->
            <div class="row mt-4 mb-4">
                <div class="col">
                    <h5 id="dance-title-blue" class="mt-4 mr-0 p-1 fw-semibold text-center"> &nbsp; </h5>
                </div>
                <div class="col">
                    <h2 id="dance-title-light" class="display-6 ml-0 p-3 fw-semibold text-center text-dark">
                        Locations
                    </h2>
                </div>
                <div class="col"> </div>
                <div class="col"> </div>
            </div>

            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                    </h4>
                    <img src="/media/events/PlaceHolderMap.png" alt="..." class="img-thumbnail">
                </div>

                <!-- Locations MUST BE PHP LOOP -->
                <div class="col-md-8 order-md-1">
                    <ul class="mx-4 list-group list-group-flush">
                        <li id="dance-locations-address-dark" class="rounded my-3 list-group-item text-center"> <a
                                href="#" class="link-primary">Location Link 1</a> Location 1 </li>
                        <li id="dance-locations-address-light" class="rounded my-3 list-group-item text-center"> <a
                                href="#" class="link-primary">Location Link 2</a> Location 2 </li>
                        <li id="dance-locations-address-dark" class="rounded my-3 list-group-item text-center"> <a
                                href="#" class="link-primary">Location Link 3</a> Location 3 </li>
                        <li id="dance-locations-address-light" class="rounded my-3 list-group-item text-center"> <a
                                href="#" class="link-primary">Location Link 4</a> Location 4 </li>
                        <li id="dance-locations-address-dark" class="rounded my-3 list-group-item text-center"> <a
                                href="#" class="link-primary">Location Link 5</a> Location 5 </li>
                        <li id="dance-locations-address-light" class="rounded my-3 list-group-item text-center"> <a
                                href="#" class="link-primary">Location Link 6</a> Location 6</li>

                    </ul>
                </div>
            </div>

            <!-- Schedule Section -->
            <!-- Schedule Title -->
            <div class="row mt-4 mb-4">
                <div class="col">
                    <h5 id="dance-title-blue" class="mt-4 mr-0 p-1 fw-semibold text-center"> .... </h5>
                </div>
                <div class="col">
                    <h2 id="dance-title-light" class="display-6 ml-0 p-3 fw-semibold text-center text-dark">Schedule
                    </h2>
                </div>
                <div class="col"> </div>
                <div class="col"> </div>
            </div>


        </div class="container">
        <!-- First Day -->
        <h4 class="text-light">[Day Name]'s Schedule </h4>

        <!-- First Day Table -->
        <table id="dance-schedule-tables" class="table">
            <thead id="dance-schedule-table-header" class="thead-light">
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Location</th>
                    <th scope="col">Artist</th>
                    <th scope="col">Session</th>
                    <th scope="col">Duration</th>
                </tr>
            </thead>
            <tbody id="dance-schedule-table-body-blue">
                <tr>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Location</td>
                    <td>Artist</td>
                    <td>Session</td>
                    <td>Duration</td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Location</td>
                    <td>Artist</td>
                    <td>Session</td>
                    <td>Duration</td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Location</td>
                    <td>Artist</td>
                    <td>Session</td>
                    <td>Duration</td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Location</td>
                    <td>Artist</td>
                    <td>Session</td>
                    <td>Duration</td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Location</td>
                    <td>Artist</td>
                    <td>Session</td>
                    <td>Duration</td>
                </tr>
            </tbody>
        </table>
        <p class="text-left text-light mb-4">* [If there's an additional note.]</p>

        <!-- Second Day -->
        <h4 class="text-light">[Second Day Name]'s Schedule </h4>

        <!-- Second Day Table -->
        <table id="dance-schedule-tables" class="table">
            <thead id="dance-schedule-table-header" class="thead-light">
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Location</th>
                    <th scope="col">Artist</th>
                    <th scope="col">Session</th>
                    <th scope="col">Duration</th>
                </tr>
            </thead>
            <tbody id="dance-schedule-table-body-pink">
                <tr>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Location</td>
                    <td>Artist</td>
                    <td>Session</td>
                    <td>Duration</td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Location</td>
                    <td>Artist</td>
                    <td>Session</td>
                    <td>Duration</td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Location</td>
                    <td>Artist</td>
                    <td>Session</td>
                    <td>Duration</td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Location</td>
                    <td>Artist</td>
                    <td>Session</td>
                    <td>Duration</td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Location</td>
                    <td>Artist</td>
                    <td>Session</td>
                    <td>Duration</td>
                </tr>
            </tbody>
        </table>
        <p class="text-left text-light mb-4">* [If there's an additional note.]</p>

        <!-- Third Day -->
        <h4 class="text-light">[Day Name]'s Schedule </h4>

        <!-- Third Day Table -->
        <table id="dance-schedule-tables" class="table">
            <thead id="dance-schedule-table-header" class="thead-light">
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Location</th>
                    <th scope="col">Artist</th>
                    <th scope="col">Session</th>
                    <th scope="col">Duration</th>
                </tr>
            </thead>
            <tbody id="dance-schedule-table-body-blue">
                <tr>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Location</td>
                    <td>Artist</td>
                    <td>Session</td>
                    <td>Duration</td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Location</td>
                    <td>Artist</td>
                    <td>Session</td>
                    <td>Duration</td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Location</td>
                    <td>Artist</td>
                    <td>Session</td>
                    <td>Duration</td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Location</td>
                    <td>Artist</td>
                    <td>Session</td>
                    <td>Duration</td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Location</td>
                    <td>Artist</td>
                    <td>Session</td>
                    <td>Duration</td>
                </tr>
            </tbody>
        </table>
        <p class="text-left text-light mb-4">* [If there's an additional note.]</p>
        </div>

        <!-- Flashback Section -->
        <!-- Flashback Title -->
        <div class="row mt-4 mb-4">
            <div class="col">
                <h5 id="dance-title-blue" class="mt-4 mr-0 p-1 fw-semibold text-center"> .... </h5>
            </div>
            <div class="col">
                <h2 id="dance-title-light" class="display-6 ml-0 p-3 fw-semibold text-center text-dark">Bringing the
                    Party Back: Photos from Previous Dance! Events
                </h2>
            </div>
            <div class="col"> </div>
            <div class="col"> </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <img src="\media\events\dance.png" alt="..." class="img-thumbnail">
                <p class="text-left text-light">[Credit to the photo]]</p>
            </div>
            <div class="col-md-3">
                <img src="\media\events\dance.png" alt="..." class="img-thumbnail">
                <p class="text-left text-light">[Credit to the photo]]</p>
            </div>
            <div class="col-md-3">
                <img src="\media\events\dance.png" alt="..." class="img-thumbnail">
                <p class="text-left text-light">[Credit to the photo]]</p>
            </div>
            <div class="col-md-3">
                <img src="\media\events\dance.png" alt="..." class="img-thumbnail">
                <p class="text-left text-light">[Credit to the photo]]</p>
            </div>
        </div>
    </main>

    <?php
        include __DIR__ . '/../footerfordance.php';
        ?>

</body>

<style>
body {
    background-color: #05050C;
}

.text-bg-light {
    background-color: #05050C;
}

#dance-header-title {
    background: linear-gradient(285.64deg, #0B24BB -4.26%, #7391F3 30.99%, #B6C1FD 64.09%, #CAD2FF 102.94%, #FFFFFF 133.88%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    color: white;
}

#dance-button-learn-more {
    background-color: white;
    color: #3366CF;
}

#dance-button-learn-more:hover {
    background-color: #3366CF;
    color: white;
    ;
}

#dance-button-buy-tickets {
    background-color: #3366CF;
    color: white;
}

#dance-button-buy-tickets:hover {
    background-color: white;
    color: #3366CF;
}

#dance-artists-learn-more-button {
    border-color: #C7DBFF;
    border-width: 3px;
    background-color: #C7DBFF;
}

#dance-artists-learn-more-button:hover {
    border-color: #679DFF;
    background-color: #679DFF;
}

#dance-artist-card-dark {
    background-color: #7A8E9A;
}

#dance-titles-slim-blue-rectangle {
    margin-bottom: 2cm;
}

#dance-title-blue {
    background-color: #3366CF;
    color: #3366CF;
}

#dance-title-light {
    background-color: #F6F6F6;
    color: #3366CF;
}

#dance-locations-address-light {
    background-color: #E7EFFF;
    color: black;
}

#dance-locations-address-darl {
    background-color: #7A8E9A;
    color: white;
}

#dance-schedule-table-header {
    background-color: white;
}

#dance-schedule-table-body-blue {
    background-color: #C7DBFF;
}

#dance-schedule-table-body-pink {
    background-color: #DFD1FF;
}

#dance-schedule-tables td,
th {
    border: 1px solid black;
}
</style>

</html>