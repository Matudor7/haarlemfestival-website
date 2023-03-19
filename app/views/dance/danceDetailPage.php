<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dance! - <?= $artist->getName() ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="/stylesheet.css" type="text/css">
</head>

<body>
    <?php include __DIR__ . "/../navfordance.php"; ?>
    <section id="dance-detail-header" class="mx-0 my-0 py-0 bg-dark"
        style="background-image: url('<?php echo $artist->getDanceArtistDetailPageBanner(); ?>');">
        <div class="mx-5 py-lg-5 justify-content text-left">
            <h1 id="dance-detail-artist-header" class="p-2 fw-semibold display-2 bg-light w-50 opacity-75 text-dark">
                <?= $artist->getName() ?>
            </h1>
            <h2 id="dance-detail-subheader" class="px-2 bg-light w-50 opacity-75 text-dark">
                <?php if ($artist->getDanceArtistSubHeader() != ""): ?>
                <?= $artist->getDanceArtistSubHeader() ?>
                <?php endif; ?>
            </h2>
        </div>

        <section id="dance-detail-header-schedule">
            <div class="row px-4 py-4 mx-0">
                <div class="col-8"></div>
                <div class="col-4 bg-light opacity-75 fw-semi-bold">
                    <h3 id="dance-detail-header-schedule-header"><?= $artist->getName() ?> is in Dance! Schedule:</h3>
                    <dl class="row">
                        <?php foreach (
                            $danceEventsByArtistId
                            as $danceEvent
                        ) { ?>
                        <dt class="col-4"> <?php echo $danceEvent
                            ->getDanceEventDateTime()
                            ->format("d/m/Y") .
                            " - " .
                            $danceEvent
                                ->getDanceEventDateTime()
                                ->format("H:i"); ?></dt>
                        <dd class="col-8"> <?php echo $danceEvent->getDanceLocationName(); ?></dd>
                        <?php } ?>
                    </dl>
                </div>
            </div>
        </section>
    </section>


    <!-- Artist Description Part -->
    <section id="dance-detail-artist-description" class="my-5 mx-5">
        <div class="row">
            <div class="col-6 pr-5">
                <p id="dance-detail-artist-description-light" class="m-5 p-4 text-dark">
                    <?= $artist->getDanceArtistLongDescription() ?> </p>
            </div>
            <div class="col-1 pr-5">

            </div>
            <div class="col-4">
                <img src="<?= $artist->getDanceArtistLongDescriptionPicture() ?>" class="mt-5 img-fluid"
                    alt="<?= $artist->getName() ?>">
            </div>
            <div class="col-1 pr-5">

            </div>

        </div>
    </section>

    <!-- Career Highlights Part -->
    <div class="row mt-4 mb-4">
        <div class="col">
            <h5 id="dance-title-blue" class="mt-4 mr-0 p-1 fw-semibold text-center"> &nbsp; </h5>
        </div>
        <div class="col">
            <h2 id="dance-title-light" class="display-6 ml-0 p-3 fw-semibold text-center text-dark">Career Highlights
            </h2>
        </div>
        <div class="col"> </div>
        <div class="col"> </div>
    </div>

    <!-- left align-->
    <?php foreach ($careerHighlights as $highlight) {
        if ($highlight->getAlignment() == 0) { ?>
    <!-- left align-->
    <section id="dance-detail-artist-career-highlights-left" class="my-5 mx-5">
        <div class="row mt-4 mb-4">
            <div class="col">
                <img src="<?= $highlight->getImageUrl() ?>" class="img-fluid"
                    alt="[Career Highlight <?= $highlight->getId() ?>]">
            </div>
            <div class="col">
                <p id="dance-detail-career-highlights-grey" class="p-4 text-dark"><?= $highlight->getDescription() ?>
                </p>
            </div>
            <div class="col"> </div>
            <div class="col"> </div>
        </div>
    </section>
    <?php } else { ?>
    <!-- right align-->
    <section id="dance-detail-artist-career-highlights-right" class="my-5 mx-5">
        <div class="row mt-4 mb-4">
            <div class="col"> </div>
            <div class="col"> </div>
            <div class="col">
                <p id="dance-detail-career-highlights-grey" class="p-4 text-dark"><?= $highlight->getDescription() ?>
                </p>
            </div>
            <div class="col">
                <img src="<?= $highlight->getImageUrl() ?>" class="img-fluid"
                    alt="[Career Highlight <?= $highlight->getId() ?>]">
            </div>
        </div>
    </section>
    <?php }
    } ?>


    <!-- Albums and Tracks Part -->
    <div class="row mt-4 mb-4">
        <div class="col">
            <h5 id="dance-title-blue" class="mt-4 mr-0 p-1 fw-semibold text-center"> &nbsp; </h5>
        </div>
        <div class="col">
            <h2 id="dance-title-light" class="display-6 ml-0 p-3 fw-semibold text-center text-dark">Important Tracks &
                Albums
            </h2>
        </div>
        <div class="col"> </div>
        <div class="col"> </div>
    </div>

    <!-- 3 Albums Part -->
    <section id="dance-detail-artist-important-albums" class="my-5 mx-5">
        <div class="container">
            <div class="row">
                <!-- This should be 3 loop -->
                <?php foreach ($albums as $album) { ?>
                <div id="dance-detail-artist-albums" class="col p-1 mx-5 rounded">
                    <div class="row">
                        <div class="col-3">
                            <img id="dance-detail-artist-albums-image"
                                src="<?= $album->getImageUrl() ?>" class="img-fluid"
                                alt="<?= $album->getName() ?> Album Cover">
                        </div>
                        <div class="col">
                            <h5><?=$album->getName() ?></h5>
                            <div class="row">
                                <div class="col-9">
                                    <h6> <?= $album->getReleaseYear() ?> </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </section>

    <!-- 4 Tracks Part -->
    <section id="dance-detail-artist-important-tracks" class="my-5 mx-5">
        <div class="row mt-4 mb-4">
            <!-- Loop From here -->
            <div class="col">
                <div class="d-flex justify-content-center my-4 mb-5">
                    <div id="mobile-box">
                        <div class="card">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img class="card-img-top rounded"
                                    src="https://mdbootstrap.com/wp-content/uploads/2019/02/flam.jpg"
                                    alt="Card image cap">
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                </a>
                            </div>
                            <div class="card-body text-left">
                                <h4 class="font-weight-bold text-left">Track Title</a></h4>
                                <h6 class="mb-0">Artist Name</h6>

                                <audio id="music" preload="true">
                                    <source src="#">
                                </audio>
                                <div id="audioplayer">
                                </div>
                                <div class="fs-4 mb-3">
                                    <svg id="pButton" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-play" viewBox="0 0 16 16">
                                        <path
                                            d="M10.804 8 5 4.633v6.734L10.804 8zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C4.713 12.69 4 12.345 4 11.692V4.308c0-.653.713-.998 1.233-.696l6.363 3.692z" />
                                    </svg>
                                    <div id="timeline">
                                        <div id="playhead"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Loop end. after looping, delete duplicated code below. -->
            <div class="col">
                <div class="d-flex justify-content-center my-4 mb-5">
                    <div id="mobile-box">
                        <div class="card">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img class="card-img-top rounded"
                                    src="https://mdbootstrap.com/wp-content/uploads/2019/02/flam.jpg"
                                    alt="Card image cap">
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                </a>
                            </div>
                            <div class="card-body text-left">
                                <h4 class="font-weight-bold text-left">Track Title</a></h4>
                                <h6 class="mb-0">Artist Name</h6>

                                <audio id="music" preload="true">
                                    <source src="#">
                                </audio>
                                <div id="audioplayer">
                                </div>
                                <div class="fs-4 mb-3">
                                    <svg id="pButton" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-play" viewBox="0 0 16 16">
                                        <path
                                            d="M10.804 8 5 4.633v6.734L10.804 8zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C4.713 12.69 4 12.345 4 11.692V4.308c0-.653.713-.998 1.233-.696l6.363 3.692z" />
                                    </svg>
                                    <div id="timeline">
                                        <div id="playhead"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex justify-content-center my-4 mb-5">
                    <div id="mobile-box">
                        <div class="card">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img class="card-img-top rounded"
                                    src="https://mdbootstrap.com/wp-content/uploads/2019/02/flam.jpg"
                                    alt="Card image cap">
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                </a>
                            </div>
                            <div class="card-body text-left">
                                <h4 class="font-weight-bold text-left">Track Title</a></h4>
                                <h6 class="mb-0">Artist Name</h6>

                                <audio id="music" preload="true">
                                    <source src="#">
                                </audio>
                                <div id="audioplayer">
                                </div>
                                <div class="fs-4 mb-3">
                                    <svg id="pButton" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-play" viewBox="0 0 16 16">
                                        <path
                                            d="M10.804 8 5 4.633v6.734L10.804 8zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C4.713 12.69 4 12.345 4 11.692V4.308c0-.653.713-.998 1.233-.696l6.363 3.692z" />
                                    </svg>
                                    <div id="timeline">
                                        <div id="playhead"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex justify-content-center my-4 mb-5">
                    <div id="mobile-box">
                        <div class="card">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img class="card-img-top rounded"
                                    src="https://mdbootstrap.com/wp-content/uploads/2019/02/flam.jpg"
                                    alt="Card image cap">
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                </a>
                            </div>
                            <div class="card-body text-left">
                                <h4 class="font-weight-bold text-left">Track Title</a></h4>
                                <h6 class="mb-0">Artist Name</h6>

                                <audio id="music" preload="true">
                                    <source src="#">
                                </audio>
                                <div id="audioplayer">
                                </div>
                                <div class="fs-4 mb-3">
                                    <svg id="pButton" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-play" viewBox="0 0 16 16">
                                        <path
                                            d="M10.804 8 5 4.633v6.734L10.804 8zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C4.713 12.69 4 12.345 4 11.692V4.308c0-.653.713-.998 1.233-.696l6.363 3.692z" />
                                    </svg>
                                    <div id="timeline">
                                        <div id="playhead"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Final Schedule Part (Schedule at the end of the page) -->
    <div class="row mt-4 mb-4">
        <div class="col-3">
            <h5 id="dance-title-blue" class="mt-4 mr-0 p-1 fw-semibold text-center"> &nbsp; </h5>
        </div>
        <div class="col-6">
            <h2 id="dance-title-light" class="display-6 ml-0 p-3 fw-semibold text-center text-dark">
                <?= $artist->getName() ?>'s
                Dance! Schedule
            </h2>
        </div>
        <div class="col-3"> </div>
    </div>

    <section id="dance-detail-artist-final-schedule" class="my-5 mx-5">
        <div class="row">
            <div id="dance-detail-artist-description-light" class="col mx-5 p-5 text-dark">
                <h4 class="mb-3"> Watch <?= $artist->getName() ?> perform at Haarlem Festival! </h4>
                <?php foreach ($danceEventsByArtistId as $danceEvent) { ?>
                <p> <?php echo $danceEvent
                    ->getDanceEventDateTime()
                    ->format("d-m-Y") .
                    " " .
                    date("l", strtotime($date)); ?> - <?php echo $danceEvent
     ->getDanceEventDateTime()
     ->format("H:i"); ?> -
                    <?php echo $danceEvent->getDanceLocationName() .
                        " " .
                        $danceEvent->getDanceEventExtraNote(); ?> </p>
                <?php } ?>
            </div>
            <div class="col">
                <img src="<?= $artist->getDanceArtistDetailPageSchedulePicture() ?>" class="img-fluid"
                    alt="<?= $artist->getName() ?>">
            </div>
        </div>
    </section>


    <?php include __DIR__ . "/../footerfordance.php"; ?>
</body>

<style>
body {
    background-color: #05050C;
}

#dance-detail-header-schedule-header {
    color: #000000;
}

#dance-detail-artist-description-light {
    background-color: #E7EFFF;
    font-size: large;
}

#dance-title-blue {
    background-color: #3366CF;
    color: #3366CF;
}

#dance-title-light {
    background-color: #F6F6F6;
    color: #3366CF;
}

#dance-detail-career-highlights-grey {
    background-color: #E7EFFF;
}

#dance-detail-artist-albums {
    background-color: #E7EFFF;
}

/* audio player */
#mobile-box {
    width: 360px;
}

.card h5 a {
    color: #0d47a1;
}

#pButton {
    float: left;
    margin-top: 12px;
    cursor: pointer;
}

#timeline {
    width: 90%;
    height: 4px;
    margin-top: 20px;
    margin-left: 10px;
    float: left;
    -webkit-border-radius: 15px;
    border-radius: 15px;
    background: rgba(0, 0, 0, 0.3);
}

#playhead {
    width: 8px;
    height: 8px;
    -webkit-border-radius: 50%;
    border-radius: 50%;
    margin-top: -2px;
    background: black;
    cursor: pointer;
}

/* audio player ended */
</style>

</html>