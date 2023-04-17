
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dance!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <?php
    require __DIR__ . '/../adminNavbar.php'
?>

    <div class="m-5 row">
        <div class="col">
            <a href="/adminDance/danceAdminManage?type=<?php echo"Artist"?>">
                <button type="button" class="btn btn-dark">Manage Dance!
                    Artists</button>
            </a>
        </div>
    </div>
    <div class="m-5 row">
        <div class="col">
        <a href="/adminDance/danceAdminManage?type=<?php echo"Location"?>">
            <button type="button" class="btn btn-success">Manage Dance!
                Venues</button>
                </a>
        </div>
    </div>
    <div class="m-5 row">
        <div class="col">
        <a href="/adminDance/danceAdminManage?type=<?php echo"Event"?>">
            <button type="button" class="btn btn-primary">Manage Dance!
                Events</button>
                </a>
        </div>
    </div>


    <script>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>