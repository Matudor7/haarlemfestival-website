
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dance! Event Homepage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="/stylesheet.css" type="text/css">
</head>

<body>
<?php include __DIR__ . "/../nav.php"; ?>
    <main class="container-fluid" id="main">
        <div class="row my-5">
            <div class="row">
                <div class="col-md-6 mt-auto p-5">
                    <h1 id="dance-header-title" class="display-4 fw-semibold">DANCE!</h1>
                    <h2 id="dance-header-description" class="lead my-3 fw-semibold text-light">Enjoy the world's best
                        DJs perform in Haarlem!</h2>
                    <button id="dance-button-learn-more" type="button" class="btn btn-primary rounded-pill fw-bold"
                        onClick="scrollToElement()">Learn More</button>
                    <button id="dance-button-buy-tickets" type="button" class="btn btn-primary rounded-pill fw-bold"
                        onClick="openForm('ticketForm')">Buy
                        Tickets</button>
                </div>
                <div class="col-md-6">
                    <img id="dance-header-image" class="m-0 p-0 bd-placeholder-img card-img-top"
                        src="media/dancePics/dance.png" alt="Banner photo">
                </div>
            </div>
        </div>


        <!--PARTICIPATING ARTISTS-->

        <div class="row mb-4">
            <div class="col">
                <h5 id="dance-title-blue" class="mt-4 mr-0 p-1 fw-semibold text-center"> &nbsp; </h5>
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
            <?php foreach ($artists as $artist) {
                if ($artist->getHasDetailPage() == 1) { ?>
            <div class="col-md-6">
                <div id="dance-artist-card-light"
                    class="row g-0 border overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-light">
                    <img class="p-2 bd-placeholder-img card-img-top"
                        src="<?php echo $artist->getArtistHomepageImageUrl(); ?>"
                        alt="<?php echo $artist->getName(); ?>'s photo">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h3 class="mb-0 fw-bold text-dark"><?php echo $artist->getName(); ?></h3>
                        <p class="card-text mb-auto"> </p>
                        <?php echo $artist->getArtistMusicTypes(); ?>
                    </div>
                    <div class="col-auto p-4 d-none d-lg-block">
                        <a href="dance/detail?artist_id=<?= $artist->getId() ?>">
                            <button id="dance-artists-learn-more-button" type="button"
                                class="btn rounded-pill mb-auto fw-semibold text-dark">
                                Learn More About the Artist
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <?php }
            } ?>
        </div>
        <!-- 4 col artists WILL BE A PHP LOOP OF 4-->
        <div class="row">
            <?php foreach ($artists as $artist) {
                if ($artist->getHasDetailPage() == 0) { ?>
            <div class="col">
                <div id="dance-artist-card-dark"
                    class="row g-0 border overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <img class="p-2 bd-placeholder-img card-img-top"
                        src="<?php echo $artist->getArtistHomepageImageUrl(); ?>"
                        alt="<?php echo $artist->getName(); ?>'s photo">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h3 class="mb-0 fw-bold text-light text-center"><?php echo $artist->getName(); ?></h3>
                        <p class="card-text mb-auto text-light text-center">
                            <?php echo $artist->getArtistMusicTypes(); ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php }
            } ?>
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
            <!--This is a placeholder now. if we can do, we'll put a map like 
            google maps there, if we cant, i will put a bootstrap carousel here -->
            <div class="col-md-4 order-md-2 mb-4">
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <?php $i = 1; foreach ($danceLocations as $danceLocation) { ?>
                        <div class="carousel-item<?php echo $i == 1 ? ' active' : ''; ?>">
                            <img src="<?php echo $danceLocation->getDanceLocationImageUrl(); ?>" class="d-block w-100"
                                alt="<?php echo $danceLocation->getDanceLocationImageUrl(); ?>'s photo">
                        </div>
                        <?php $i++; } ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-8 order-md-1">
                <ul class="mx-4 list-group list-group-flush">
                    <!-- Locations Loop-->
                    <?php foreach ($danceLocations as $danceLocation) { ?>
                    <li id="dance-locations-address-light" class="rounded my-3 list-group-item text-center fw-semibold">
                        <a href="<?php echo $danceLocation->getDanceLocationUrlToTheirSite(); ?>"
                            class="link-primary"><?php echo $danceLocation->getDanceLocationName(); ?></a> |
                        <?php echo $danceLocation->getDanceLocationName() .
                            " " .
                            $danceLocation->getDanceLocationNumber() .
                            ", " .
                            $danceLocation->getDanceLocationPostcode() .
                            ", " .
                            $danceLocation->getDanceLocationCity(); ?>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <!-- Schedule Section -->
        <!-- Schedule Title -->
        <div id="dance-homepage-schedule" class="row mt-4 mb-4">
            <div class="col">
                <h5 id="dance-title-blue" class="mt-4 mr-0 p-1 fw-semibold text-center"> &nbsp; </h5>
            </div>
            <div class="col">
                <h2 id="dance-title-light" class="display-6 ml-0 p-3 fw-semibold text-center text-dark">Schedule
                </h2>
            </div>
            <div class="col"> </div>
            <div class="col"> </div>
        </div>

        </div class="container">
        <?php // Create a table for each day's events
        foreach ($danceEventsByDate as $date => $events) { ?>
        <h4 class="text-light"><?php echo date(
            "l",
            strtotime($date)
        ); ?>'s Schedule </h4>
        <table id="dance-schedule-tables" class="table">
            <colgroup>
                <col class="date" style="width:10%">
                <col class="time" style="width:10%">
                <col class="location" style="width:20%">
                <col class="artist" style="width:30%">
                <col class="session" style="width:20%">
                <col class="duration" style="width:10%">
            </colgroup>
            <thead id="dance-schedule-table-header" class="thead-light">
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Location</th>
                    <th scope="col">Artist</th>
                    <th scope="col">Session</th>
                    <th scope="col">Duration approx.</th>
                </tr>
            </thead>
            <tbody id="dance-schedule-table-body-blue">
                <?php foreach ($events as $danceEvent) { ?>
                <tr>
                    <td><?php echo $danceEvent
                        ->getDanceEventDateTime()
                        ->format("d-m-Y") .
                        " " .
                        date("l", strtotime($date)); ?>
                    </td>
                    <td><?php echo $danceEvent
                        ->getDanceEventDateTime()
                        ->format("H:i"); ?></td>
                    <td><?php echo $danceEvent->getDanceLocationName(); ?></td>
                    <td><?php echo $danceEvent->getPerformingArtists(); ?></td>
                    <td><?php echo $danceEvent->getDanceSessionTypeName(); ?></td>
                    <td><?php echo $danceEvent->getDanceEventDuration() .
                        " mins"; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php // Check if the extraNote is not null, and print it for each event
        foreach ($events as $danceEvent) {
            if ($danceEvent->getDanceEventExtraNote() != null) {
                echo '<p class="text-left text-light mb-4">' .
                    $danceEvent->getDanceEventExtraNote() .
                    "</p>";
            }
        } ?>
        <?php } ?>

        <!-- Flashback Section -->
        <!-- Flashback Title -->
        <div class="row mt-4 mb-4">
            <div class="col-3">
                <h5 id="dance-title-blue" class="mt-4 mr-0 p-1 fw-semibold text-center"> &nbsp; </h5>
            </div>
            <div class="col-6">
                <h2 id="dance-title-light" class="display-6 ml-0 p-3 fw-semibold text-center text-dark">Bringing the
                    Party Back: Photos from Previous Dance! Events
                </h2>
            </div>
            <div class="col-3"> </div>
        </div>
        <div class="row">
            <?php foreach ($danceFlashbacks as $flashback) { ?>
            <div class="col-md-3 my-4">
                <img src="<?php echo $flashback->getDanceFlashbackUrl(); ?>"
                    alt="<?php echo $flashback->getDanceFlashbackCredit(); ?>'s Photo"
                    class="card-img-top h-100 border">
                <p class="text-left text-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                        <path
                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                    </svg><?php echo " " .
                        $flashback->getDanceFlashbackCredit(); ?></p>
            </div>
            <?php } ?>
        </div>
    </main>

    <?php include __DIR__ . "/../footer.php"; ?>


    <script src="/js/scriptfile.js"></script>
</body>

<style>
body {
    background-color: #010104;
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
    font-size: 800%;
}

#dance-header-description {
    font-size: 250%;
}

#dance-button-learn-more {
    background-color: white;
    color: #3366CF;
}

#dance-button-learn-more:hover {
    background-color: #3366CF;
    color: white;

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

#dance-schedule-table-header {
    background-color: white;
}

#dance-schedule-table-body-blue {
    background-color: #C7DBFF;
}

#dance-schedule-tables td,
th {
    border: 1px solid black;
}
</style>

</html>