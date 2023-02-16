
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
        
        <nav class="navbar bg-dark d-flex flex-column mb-3 align-items-center pt-0 sticky-top">
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
                        <a class="nav-link text-light fw-bold text-center" href="History">A Stroll Through Histrory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light fw-bold text-center" href="/DrTeylers">Dr Teyler's Secret</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle text-light fw-bold" href="#" role="button" data-bs-toggle="dropdown" data-bs-placement="bottom" aria-expanded="false">Visit Haarlem</a>
                            <ul class="dropdown-menu dropdown-menu-end bg-light my-0 me-5 py-0 border-0 border rounded-0">
                            <li><a class="dropdown-item text-secondary" href="#">History</a></li>
                            <li><a class="dropdown-item text-secondary" href="#">Food</a></li>
                            <li><a class="dropdown-item text-secondary" href="#">Entertainment</a></li>
                            </ul>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="btn btn-primary rounded-pill mx-1 px-3 mt-1" onClick="location.href='/CreateProgram'">Create a Program</button>
                    </li>
                </ul>
        </nav>

        <style>
            body{
                background-color: blueviolet;
            }

            .dropdown-item:hover {
                background-color: #282323;
            }

            .btn:hover{
                background-color: white;
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