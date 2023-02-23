<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dance Detail Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="/stylesheet.css" type="text/css">
</head>

<body>
    <section id="dance-detail-header" class="mx-0 my-0 py-0 bg-dark">
        <img src="media\homepagemedia\Banner.png" class="img-fluid py-0" alt="banner">
        <div id="dance-detail-header" class="mx-5 py-lg-5 justify-content text-left">
            <h1 id="dance-detail-artist-header" class="fw-semibold display-2 bg-light w-50 opacity-75 text-dark">Artist
                Name</h1>
            <h2 id="dance-detail-subheader" class="bg-light w-50 opacity-75 text-dark">Artist Subheader</h2>
        </div>

        <section id="dance-detail-header-schedule">
            <div class="row px-4 py-4">
                <div class="col-8"></div>
                <div class="col-4 bg-light opacity-75 fw-semi-bold">
                    <h3 id="dance-detail-header-schedule-header">[Artist
                        Name] is in [Festival Name]!!</h3>
                    <dl class="row">
                    <dt class="col-3">[Date] - [Time]</dt>
                        <dd class="col-9">Place</dd>
                        <dt class="col-3">[Date] - [Time]</dt>
                        <dd class="col-9">Place</dd>
                        <dt class="col-3">[Date] - [Time]</dt>
                        <dd class="col-9">Place</dd>
                </div>
            </div>
        </section>
    </section>

    <section id="dance-detail-artist-description" class="my-5 mx-5">
        <div class="row">
            <div class="col-8 pr-5">
                <p id="dance-detail-artist-description-light" class="p-4 text-dark"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque aliquam massa at libero tempus accumsan. Nam venenatis suscipit ligula, ac aliquam ipsum rutrum vel. Donec laoreet ante scelerisque congue commodo. Maecenas vitae sagittis sapien. Nullam pellentesque ornare lorem, vel euismod leo tempor vel. Curabitur sit amet hendrerit nisl, in pharetra quam. Fusce mattis lobortis sapien sed bibendum. Aliquam aliquet luctus orci, at fermentum nibh condimentum nec. In hac habitasse platea dictumst. </p>
            </div>
            <div class="col-4">
            <img src="..." class="img-fluid" alt="[Artist name]">
            </div>
        </div>
    </section>

</body>

<style>
body {
    background-color: #05050C;
}

#dance-detail-header-schedule-header {
    color: #000000;
}
#dance-detail-artist-description-light{
    background-color: #E7EFFF;
}
</style>

</html>