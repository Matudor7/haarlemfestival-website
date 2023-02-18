
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
    <div id="banner-text" class="row mt-5 py-lg-5 justify-content text-center">
        <h1 class="fw-semibold display-2 text-nowrap">The Festival Haarlem</h1>
        <p class=" text-light fs-2">Haarlem's main event opens up again</p>

        <div id="date-container" class="container bg-light w-50 opacity-75">
        <h2 id="dateText" class="text-dark">Start Date - End Date Year</h2>
        </div>
    </div>
  </section>

        
  <section class="mx-0 my-5 py-0 bg-light">
    <div class="py-lg-5 justify-content text-center">
        <h4 class="fw-semibold text-nowrap display-6">What's there to do?</h4>
        <p class="text-dark fs-5 mx-5">From partying to fulfilling your gastronomic needs to strolling through historical landmarks, The Festival covers many of your possible desires.</p>
    </div>
  </section>

  <section id="detail-page-1" class="mx-0 my-5 py-0 bg-light">
    <img src="media\homepagemedia\detail-page-1-banner.png" class="img-fluid py-0" alt="banner" >
    
        <h2 id="detail-page-1-title" class="fw-semibold text-nowrap display-1">Event Title</h2>
        <p id="detail-page-1-description" class="text-light text-center">Here will go a DESCRIPTION of the event to promote traffic to the event's detail page. It is dynamic so it should be changed through the database table.</p>

    <button type="button" class="btn btn-dark border boder-light rounded-pill mx-1 px-3 mt-1 fw-bold" onclick="location.href='#'">Go To Page</button>
  </section>

  <section id="detail-page-2" class="mx-0 my-5 py-0 bg-light">
    <img id="detail-page-2-img" src="media\homepagemedia\detail-page-2-banner.png" class="img-fluid py-0" alt="banner" >
    <img id="detail-page-2-logo" src="media\homepagemedia\detail-page-2-logo.png" class="img-fluid py-0" alt="logo" >
        <h2 id="detail-page-2-title" class="fw-semibold display-6 text-center">Event Title</h2>
        
        <p id="detail-page-2-description" class="text-light text-center">Here will go a DESCRIPTION of the event to promote traffic to the event's detail page. It is dynamic so it should be changed through the database table.</p>
    <button type="button" class="btn border boder-light rounded-pill mx-1 px-3 mt-1 fw-bold" onclick="location.href='#'">Go To Page</button>
  </section>

  <section id="detail-page-3" class="mx-0 my-5 py-0 bg-light">
    <img id="detail-page-3-img" src="media\homepagemedia\detail-page-3-banner.png" class="img-fluid py-0" alt="banner" >
    <img id="detail-page-3-logo" src="media\homepagemedia\detail-page-3-logo.png" class="py-0" alt="logo" >
        <h2 id="detail-page-3-title" class="fw-semibold text-center">A Stroll Through History</h2>
        
        <p id="detail-page-3-description" class="text-light text-center">Here will go a DESCRIPTION of the event to promote traffic to the event's detail page. It is dynamic so it should be changed through the database table.</p>
    <button type="button" class="btn border boder-light rounded-pill mx-1 px-3 mt-1 fw-bold text-light" onclick="location.href='#'">Go To Page</button>
  </section>

  <section class="mx-0 my-5 py-0 bg-light">
    <div class="py-lg-5 justify-content text-center">
        <h4 class="fw-semibold text-nowrap display-6 mb-5">Where to find The Festival?</h4>
        <p class="text-dark fs-5 mx-5">The Festival takes place in Haarlem, a student city situated to the west of Amsterdam and north of The Hague.</p>

        <div id="API-container" class="container mt-5">
        <img id="API-placeholder" src="media\homepagemedia\API-placeholder.png" class="img-fluid py-0" alt="map" >
        </div>

    </div>
  </section>

  <section class="mx-0 my-5 py-0 bg-light">
    <div class="py-lg-5 justify-content text-center">
        <h4 class="fw-semibold text-nowrap display-6 mb-5">Make your own program!</h4>
        <p class="text-dark fs-5 mx-5">Whether you come to the festival solo or with a family, it is a good idea to create a program for yourself in advance. Think of all the events you want to attend and organize them to your liking.</p>
        
        <button id="program-button-large" type="button" class="btn btn-primary rounded-pill mx-1 p-0 mt-5 w-25 fs-3" onClick="location.href='/CreateProgram'">Create a Program</button>

    </div>
  </section>

  <section id="ad-section" class="mx-0 my-5 py-0">
        
        <img src="media\homepagemedia\ad-placeholder.png" class="img-fluid py-0" alt="ad" >
        <button type="button" class="btn rounded-pill px-3 mt-5 fw-bold" onClick="#">Click Here</button>

  </section>


    <?php include __DIR__ . '/../footer.php';?>


        <style>

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

                #date-container{
                    position: absolute;
                    top: 98%;
                    left: 50%;
                    transform: translate(-50%, 0%);
                    color: white;
                }

                .img-fluid{
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }

                #detail-page-1{
                    position: relative;
                    width: 100%;
                    height: 100%;
                    background-color: white;
                }

                #detail-page-1 img{
                    position: relative;
                    z-index: 1;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
                #detail-page-1 button{
                    position: absolute;
                    top: 55%;
                    left: 20%;
                    width: 15%;
                    height: 8%;
                    transform: translate(-50%, -50%);
                    z-index: 2;

                }

                #detail-page-1-title{
                    position: absolute;
                    top: 15%;
                    left: 20%;
                    transform: translate(-50%, -50%);
                    z-index: 2;
                    color: white;
                }

                #detail-page-1-description{
                    position: absolute;
                    top: 35%;
                    left: 20%;
                    max-width: 30%;
                    transform: translate(-50%, -50%);
                    z-index: 2;
                    color: white;
                }

                #detail-page-2{
                    position: relative;
                    width: 100%;
                    height: 100%;
                    background-color: white;
                }

                #detail-page-2-img{
                    position: relative;
                    z-index: 1;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }

                #detail-page-2-logo{
                    position: absolute;
                    top: 0%;
                    left: 50%;
                    transform: translate(-50%, 0%);
                    z-index: 2;
                }
                #detail-page-2 button{
                    position: absolute;
                    top: 65%;
                    left: 20%;
                    width: 15%;
                    height: 8%;
                    transform: translate(-50%, -50%);
                    z-index: 2;
                    background-color: #EC5F41;
                    border-width: 2px;
                    border-color: #09B4BB ;

                }

                #detail-page-2-title{
                    position: absolute;
                    top: 20%;
                    left: 49%;
                    transform: translate(-50%, -50%);
                    z-index: 2;
                    color: black;
                    max-width: 20%;
                }

                #detail-page-2-description{
                    position: absolute;
                    top: 50%;
                    left: 20%;
                    max-width: 30%;
                    transform: translate(-50%, -50%);
                    z-index: 2;
                    color: black;
                    background-color: #09B4BB;
                    border-radius: 15px;
                    padding: 15px;
                }

                #detail-page-3{
                    position: relative;
                    width: 100%;
                    height: 100%;
                    background-color: white;
                }

                #detail-page-3-img{
                    position: relative;
                    z-index: 1;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }

                #detail-page-3-logo{
                    width: 400px;
                    height: 200px;
                    position: absolute;
                    top: 20%;
                    left: 50%;
                    transform: translate(-50%, 0%);
                    z-index: 2;
                }
                #detail-page-3 button{
                    position: absolute;
                    top: 75%;
                    left: 50%;
                    width: 15%;
                    height: 8%;
                    transform: translate(-50%, -50%);
                    z-index: 2;
                    background-color: #8564CC;
                    border-width: 2px;
                    border-color: #09B4BB ;

                }

                #detail-page-3-title{
                    position: absolute;
                    font-family: Bubblegum Sans;
                    top: 27%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    z-index: 2;
                    color: white;
                    max-width: 40%;
                }

                #detail-page-3-description{
                    position: absolute;
                    font-family: Bubblegum Sans;
                    top: 38%;
                    left: 50%;
                    max-width: 30%;
                    transform: translate(-50%, -50%);
                    z-index: 2;
                    color: black;
                }

                #API-container{
                    position: relative;
                    width: 500px;
                    height: 450px;
                    background-color: white;
                }

                #program-button-large{
                    height: 50px;}
         
                #ad-section{
                    position: relative;
                    width: 100%;
                    height: 100%;
                }

                #ad-section img{
                    position: relative;
                    z-index: 1;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }

                #ad-section button{
                    position: absolute;
                    top: 80%;
                    left: 81%;
                    transform: translate(-50%, -50%);
                    z-index: 2;
                    background-color: #7EC745;
                }

            </style>


    </body>
</html>