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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/stylesheet.css" type="text/css">
</head>

<body>
    <?php //if the page is dance, the logo changes to dark background and light font, if not, it is white bg and dark font
    if (
        $_SERVER["REQUEST_URI"] == "/dance" ||
        strpos($_SERVER["REQUEST_URI"], "/dance/detail") === 0
    ) {
        echo '<nav class="navbar bg-light d-flex flex-column mb-0 align-items-center pt-0 sticky-top">';
    } else {
        echo '<nav class="navbar bg-dark d-flex flex-column mb-0 align-items-center pt-0 sticky-top">';
    } ?>
    <a class="navbar-brand px-0 mx-0 py-0" href="/">
        <?php //if the page is dance, the logo changes to dark background and light font, if not, it is white bg and dark font
        if (
            $_SERVER["REQUEST_URI"] == "/dance" ||
            strpos($_SERVER["REQUEST_URI"], "/dance/detail") === 0
        ) {
            echo '<img src="/media/NavbarLogoForDance.jpg" class="img-fluid" alt="Logo">';
        } else {
            echo '<img src="/media/NavbarLogo.jpg" class="img-fluid" alt="Logo">';
        } ?>
    </a>
    <?php //if the page is dance, the logo changes to dark background and light font, if not, it is white bg and dark font
    if (
        $_SERVER["REQUEST_URI"] == "/dance" ||
        strpos($_SERVER["REQUEST_URI"], "/dance/detail") === 0
    ) {
        echo '<ul class="nav bg-light d-flex flex-nowrap">';
    } else {
        echo '<ul class="nav bg-dark d-flex flex-nowrap">';
    } ?>
    <li class="nav-item">
        <?php //if the page is dance, the logo changes to dark background and light font, if not, it is white bg and dark font
        if (
            $_SERVER["REQUEST_URI"] == "/dance" ||
            strpos($_SERVER["REQUEST_URI"], "/dance/detail") === 0
        ) {
            echo '<a class="nav-link active text-dark fw-bold" aria-current="page" href="/">Home</a>';
        } else {
            echo '<a class="nav-link active text-light fw-bold" aria-current="page" href="/">Home</a>';
        } ?>
    </li>
    <?php foreach ($events as $event) { ?>
    <li class="nav-item">
        <?php //if the page is dance, the logo changes to dark background and light font, if not, it is white bg and dark font
        if (
            $_SERVER["REQUEST_URI"] == "/dance" ||
            strpos($_SERVER["REQUEST_URI"], "/dance/detail") === 0
        ) {
            echo '<a class="nav-link text-dark fw-bold"';
        } else {
            echo '<a class="nav-link text-light fw-bold"';
        } ?>
        href="<?php echo $event->getUrlRedirect(); ?>"><?php echo $event->getName(); ?></a>
    </li>
    <?php } ?>
    <li class="nav-item" style="margin-top:3px">
        <a class="btn btn-primary rounded-pill mx-1 px-3 mt-1 fa fa-shopping-cart" data-bs-toggle="offcanvas"
            role="button" href="#offcanvas"></a>
    </li>
    <li class="nav-item">
        <button type="button" class="btn btn-success rounded-pill ms-5 me-1 px-3 mt-1"
            onClick="location.href='/login'">Login</button>
    </li>
    <li>
        <?php if (isset($_SESSION["user"])) {
            echo "<a class='nav-link' style='color: white; href='/admin/manageRestaurantPage'>Manage Restaurants</a>"; ?>
    </li>
    <li>
        <?php echo "<a class='nav-link' style='color: white; href='/admin/registerUser'>Register User</a>";
        } ?> </li>
    </ul>

    <?php if (isset($_SESSION["user"])) { ?>
    <button type="button" class="btn btn-success ;" onClick="location.href='/logOut'" STYLE="margin: 2px 30px;">Log
        out</button>&nbsp;
    <?php } ?>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasLabel">Shopping Cart</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <!-- This is where the shopping cart loop goes !-->
            <?php foreach ($merged_products as $product) { ?>
            <div style="display: flex; justify-content: space-between; align-items: center">
                <div>
                    <button type="button" class="btn btn-primary" style="padding: 5px 5px">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus" viewBox="0 0 16 16">
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                            </path>
                        </svg>
                    </button>
                    <h6 style="text-align: center"><?php echo $product->getId(); ?></h6>
                    <button type="button" class="btn btn-primary" style="padding: 5px 5px">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-dash" viewBox="0 0 16 16">
                            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                        </svg>
                    </button>
                </div>
                <div style="margin-left: 20px">
                    <h2><?php echo $product->getName(); ?></h2>
                    <h6><?php echo $product->getLocation(); ?></h6>
                    <p><?php echo $product->getStartTime(); ?></p>
                </div>
                <div>
                    <h3><?php echo $product->getPrice(); ?></h3>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    </nav>
    <script src="/js/scriptfile.js"></script>
</body>

</html>
<style>
.form-popup {
    display: none;
    position: fixed;
    top: 63%;
    left: 50%;
    transform: translate(-50%, -50%);
    border: 3px solid #000000;
    z-index: 9;
}

/* Add styles to the form container */
.form-container {
    max-width: 500px;
    max-height: 500px;
    padding: 10px;
    background-color: white;
}

.form-container h1 {
    text-align: center;
}

/* Full-width input fields */
.form-container input[type=text],
.form-container input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    border: none;
    background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus,
.form-container input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
    background-color: #04AA6D;
    color: white;
    padding: 16px 20px;
    border: none;
    cursor: pointer;
    width: 100%;
    margin: 15px;
    opacity: 0.8;
    max-width: 200px;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
    background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover,
.open-button:hover {
    opacity: 1;
}
</style>