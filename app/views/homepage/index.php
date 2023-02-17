
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
        
        <nav class="navbar bg-dark d-flex flex-column mb-0 align-items-center pt-0 sticky-top">
             <a class="navbar-brand px-0 mx-0 py-0" href="#">
            <img src="media/NavbarLogo.jpg" class="img-fluid " alt="Logo">
             </a>
                <ul class="nav bg-dark d-flex flex-nowrap">
                    <li class="nav-item">
                        <a class="nav-link active text-light fw-bold" aria-current="page" href="Home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light fw-bold" href="/Yummy">Yummy!</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light fw-bold" href="/Dance">Dance!</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light fw-bold text-center" href="History">Walking Tour!</a>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-primary rounded-pill mx-1 px-3 mt-1" onClick="location.href='/CreateProgram'">Create a Program</button>
                    </li>

                    <li class="nav-item">
                        <button type="button" class="btn btn-success rounded-pill ms-5 me-1 px-3 mt-1" onClick="#">Login</button>
                    </li>
                </ul>
        </nav>

        
        <footer id="secondversion" class="container bg-dark">
            <div id="logo-div" class="col-4">
            <a class="navbar-brand px-0 mx-0 py-0" href="#">
            <img src="media/FooterLogo.jpg" class="img-fluid " alt="Logo">
             </a>
      <p class="text-muted-light text-light">© 2023</p>
            </div>
            <div id="section-div" class="col-8">
                <div id="yummy-div" class="col">
                <h5 class="text-light fw-bold">Yummy!</h5>
                <ul class="nav flex-column">
                <li class="nav-item mb-1"><a href="#" class="nav-link p-0 text-light text-muted-light">Specktackle</a></li>
                <li class="nav-item mb-1"><a href="#" class="nav-link p-0 text-light text-muted-light lh-sm">Restaurant<br>Mr. & Mrs.</a></li>
                </ul>
                </div>
                <div id="Dance-div">
                    
                </div>
                <div id="Walking-div">
                    
                </div>
                <div id="contact-div">
                    
                </div>
            </div>
        </footer>




        <footer id="firstversion" class="row row-cols-1 row-cols-sm-2 flex-nowrap row-cols-md-5 mx-0 py-0 mt-5 mb-0 border-top bg-dark">
    <div class="col mb-3">
    <a class="navbar-brand px-0 mx-0 py-0" href="#">
            <img src="media/FooterLogo.jpg" class="img-fluid " alt="Logo">
      </a>
      <p class="text-muted-light text-light">© 2023 first version</p>
    </div>



    <div class="col my-3 mx-1 text-center">
      <h5 class="text-light fw-bold">Yummy!</h5>
      <ul class="nav flex-column">
        <li class="nav-item mb-1"><a href="#" class="nav-link p-0 text-light text-muted-light">Specktackle</a></li>
        <li class="nav-item mb-1"><a href="#" class="nav-link p-0 text-light text-muted-light lh-sm">Restaurant<br>Mr. & Mrs.</a></li>
      </ul>
    </div>

    <div class="col my-3 mx-2 text-center">
      <h5 class="text-light fw-bold">Dance!</h5>
      <ul class="nav flex-column">
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light text-muted-light">Afrojack</a></li>
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light text-muted-light">Martin Garrix</a></li>
      </ul>
    </div>

    <div class="col my-3 mx-2 text-center">
      <h5 class="text-light fw-bold">Walking Tour!</h5>
      <ul class="nav flex-column">
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light text-muted-light">Home</a></li>
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light text-muted-light">Features</a></li>
      </ul>
    </div>

    <div class="col my-3 mx-2 pe-0">
      <h6 class="text-light fs-5 box-sizing-content-box">Contact</h6>
      <ul class="nav flex-column box-sizing-content-box">
        <li class="nav-item mb-2 box-sizing-content-box"><a href="#" class="nav-link p-0 text-light text-muted-light fs-6">Email</a></li>
        <li class="nav-item mb-2 box-sizing-content-box"><a href="#" class="nav-link p-0 text-light text-muted-light fs-6">Follow Us: </a></li>
        <li class="nav-item mb-2 box-sizing-content-box"><a href="#" class="nav-link p-0 text-light text-muted-light">social media</a></li>

      </ul>
    </div>

    
  </footer>

        <style>
            body{
                background-color: blueviolet;
            }

            .dropdown-item:hover {
                background-color: #282323;
            }

            .navbar-nav .dropdown-menu {
               position: absolute;
               top: 100%;
               left:0;
               right: 100%;
            }
            </style>

    </body>
</html>