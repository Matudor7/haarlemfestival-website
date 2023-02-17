
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Homepage</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="/stylesheet.css" type="text/css">
        
    </head>
    <body>
    <?php include __DIR__ . '/../nav.php';?>
    
    <section id="header" class="mx-0 my-0 py-0 bg-light">
    <img src="media\homepagemedia\Banner.png" class="img-fluid py-0" alt="banner" >
    <div id="banner-text"class="row mt-5 py-lg-5 justify-content text-center">
        <h1 class="fw-semibold display-2 text-nowrap">The Festival Haarlem</h1>
        <p class=" text-light fs-2">Haarlem's main event opens up again</p>
        <p>
        </p>

        <div class="container bg-light w-50 opacity-75">
        <h2 id="dateText" class="text-dark">Start Date - End Date Year</h2>
        </div>
    </div>
  </section>

        


    <?php include __DIR__ . '/../footer.php';?>
        <style>
            body{
                background-color: blueviolet;
            }

            .bi {
                fill: white;
                }

                #banner-text{
                    position: absolute;
                    top: 15%;
                    left: 50%;
                    transform: translate(-50%, 0%);
                    color: white;
                }

                #banner-text h1{
                    font-size: 80;
                }

                .img-fluid{
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }

            </style>


    </body>
</html>