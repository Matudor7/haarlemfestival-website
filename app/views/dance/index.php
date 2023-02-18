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
                    <button type="button" class="btn btn-primary rounded-pill fw-bold">Learn More</button>
                    <button type="button" class="btn btn-primary rounded-pill fw-bold ">Buy Tickets</button>
                </div>
            </div>

            <!-- <div class="p-3 mb-2 bg-light text-dark fw-bold">PARTICIPATING ARTISTS</div> -->

            <div class="row">
                <div class="col"> <h4 id="dance-title-light" class="p-1 bg-light fw-semibold"></h4> </div>
                <div class="col"> <h2 id="dance-title-light" class="display-5 p-1 bg-light fw-semibold">Participating Artists</h2> </div>
                <div class="col"> </div>
                <div class="col"> </div>
            </div>

            <!-- 2 col artists -->

            <div class="col-md-6">
                <div id="dance-artist-card-light"
                    class="row g-0 border overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-light">
                    <svg class="p-2 bd-placeholder-img card-img-top" width="100%" height="225"
                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                        preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                            dy=".3em">Artist's photo</text>
                    </svg>
                    <div class="col p-4 d-flex flex-column position-static">
                        <h3 class="mb-0 fw-bold text-dark">ARTIST NAME</h3>
                        <p class="card-text mb-auto">ARTIST GENRE(s)</p>

                    </div>
                    <div class="col-auto p-4 d-none d-lg-block">
                        <button id="dance-artists-learn-more-button" type="button"
                            class="btn rounded-pill mb-auto fw-semibold text-dark">Learn More About the Artist</button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div id="dance-artist-card-dark"
                    class="row g-0 border overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <svg class="p-2 bd-placeholder-img card-img-top" width="100%" height="225"
                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                        preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                            dy=".3em">Artist's photo</text>
                    </svg>
                    <div class="col p-4 d-flex flex-column position-static">
                        <h3 class="mb-0 fw-bold text-light">ARTIST NAME</h3>
                        <p class="card-text mb-auto text-light">ARTIST GENRE(s)</p>

                    </div>
                    <div class="col-auto p-4 d-none d-lg-block">
                        <button id="dance-artists-learn-more-button" type="button"
                            class="btn rounded-pill mb-auto fw-semibold text-dark">Learn More About the Artist</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 4 col artists -->
        <div class="row">
            <div class="col">
                <div id="dance-artist-card-dark"
                    class="row g-0 border overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <svg class="p-2 bd-placeholder-img card-img-top" width="100%" height="225"
                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                        preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                            dy=".3em">Artist's photo</text>
                    </svg>
                    <div class="col p-4 d-flex flex-column position-static">
                        <h3 class="mb-0 fw-bold text-light">ARTIST NAME</h3>
                        <p class="card-text mb-auto text-light">ARTIST GENRE(s)</p>

                    </div>
                </div>
            </div>
            <div class="col">
                <div id="dance-artist-card-light"
                    class="row g-0 border overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-light">
                    <svg class="p-2 bd-placeholder-img card-img-top" width="100%" height="225"
                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                        preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                            dy=".3em">Artist's photo</text>
                    </svg>
                    <div class="col p-4 d-flex flex-column position-static">
                        <h3 class="mb-0 fw-bold">ARTIST NAME</h3>
                        <p class="card-text mb-auto">ARTIST GENRE(s)</p>

                    </div>
                </div>
            </div>
            <div class="col">
                <div id="dance-artist-card-dark"
                    class="row g-0 border overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <svg class="p-2 bd-placeholder-img card-img-top" width="100%" height="225"
                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                        preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                            dy=".3em">Artist's photo</text>
                    </svg>
                    <div class="col p-4 d-flex flex-column position-static">
                        <h3 class="mb-0 fw-bold text-light">ARTIST NAME</h3>
                        <p class="card-text mb-auto text-light">ARTIST GENRE(s)</p>

                    </div>
                </div>
            </div>
            <div class="col">
                <div id="dance-artist-card-light"
                    class="row g-0 border overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-light">
                    <svg class="p-2 bd-placeholder-img card-img-top" width="100%" height="225"
                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                        preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                            dy=".3em">Artist's photo</text>
                    </svg>
                    <div class="col p-4 d-flex flex-column position-static">
                        <h3 class="mb-0 fw-bold">ARTIST NAME</h3>
                        <p class="card-text mb-auto">ARTIST GENRE(s)</p>

                    </div>
                </div>
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

#dance-artists-learn-more-button {
    background-color: #C7DBFF;
}

#dance-artist-card-dark {
    background-color: #7A8E9A;
}

#dance-titles-slim-blue-rectangle {
    margin-bottom: 2cm;
}
</style>

</html>