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
    <nav class="navbar bg-dark d-flex flex-column mb-0 align-items-center pt-0 sticky-top">
        <a class="navbar-brand px-0 mx-0 py-0" href="/">
            <img src="/media/NavbarLogo.jpg" class="img-fluid" alt="Logo">
            <div class="share">
                
                <button id="twitter-button" class="btn btn-primary mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-twitter" viewBox="0 0 16 16">
                        <path
                            d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                    </svg>
                </button>
                <button id="facebook-button" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-facebook" viewBox="0 0 16 16">
                        <path
                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                    </svg>
                </button>
            </div>
        </a>
        <ul class="nav bg-dark d-flex flex-nowrap">
            <li class="nav-item">
                <a class="nav-link active text-light fw-bold" aria-current="page" href="/">Home</a>
            </li>
            <?php foreach ($events as $event) { ?>
            <li class="nav-item">
                <a class="nav-link text-light fw-bold"
                    href="<?php echo $event->getUrlRedirect(); ?>"><?php echo $event->getName(); ?></a>
            </li>
            <?php } ?>

            <li class="nav-item" style="margin-top:3px">
                <a class="btn btn-primary rounded-pill mx-1 px-3 mt-1 fa fa-shopping-cart" data-bs-toggle="offcanvas"
                    role="button" href="#offcanvas"></a>
            </li>
            <li>
                <?php if (isset($_SESSION["user_id"])&& isset($_SESSION["user_role"])&& $_SESSION["user_role"] == 2) { //only admins should see these
        echo "<a class='nav-link' style='color: white;' href='/admin'>Manage Website</a>";
    } ?>
            </li>

            <li>
                <?php if (isset($_SESSION["user_id"])&& isset($_SESSION["user_role"])) { 

            echo "<a class='nav-link' style='color: white;' href='/user/userManageAccount'>Manage Account</a>";  } ?>
            </li>

            <li>
                <?php if (isset($_SESSION["user_id"])&& isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 1) { 
            echo "<a class='nav-link' style='color: white;' href='/scanTicket'>Scan Tickets</a>";  } ?>
            </li>


            <?php if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] < 999999) { ?>
            <button type="button" class="btn btn-danger ;" onClick="location.href='/login/logOut'"
                STYLE="margin: 2px 30px;">Log
                out</button>&nbsp;
            <?php }else{ ?> <li class="nav-item">
                <button type="button" class="btn btn-success rounded-pill ms-5 me-1 px-3 mt-1"
                    onClick="location.href='/login'">Login</button>
            </li><?php }?>
        </ul>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasLabel">Shopping Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <!-- This is where the shopping cart loop goes !-->
                <?php for($i = 0; $i < count($merged_products); $i++)
                    {?>
                <div id="productdiv <?php echo $i?>"
                    style="display: flex; justify-content: space-between; align-items: center; background-color:#F8F8F8">
                    <div>
                        <button type="button" class="btn btn-primary" style="padding: 5px 5px" id="addButton"
                            onclick="addAmount(<?php echo $i?>, <?php echo $_SESSION['user_id']?>, <?php echo $merged_products[$i]->getId()?>, <?php echo $merged_products[$i]->getAvailableSeats()?>)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-plus" viewBox="0 0 16 16">
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                                </path>
                            </svg>
                        </button>
                        <h6 id="productamount <?php echo $i?>" style="text-align: center"><?php echo $amounts[$i]?></h6>
                        <button type="button" class="btn btn-primary" style="padding: 5px 5px" id="removeButton"
                            onclick="removeAmount(<?php echo $i?>, <?php echo $_SESSION['user_id']?>, <?php echo $merged_products[$i]->getId()?>)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-dash" viewBox="0 0 16 16">
                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                            </svg>
                        </button>
                    </div>
                    <div style="margin-left: 20px">
                        <h2><?php echo $merged_products[$i]->getName()?></h2>
                        <h6><?php echo $merged_products[$i]->getLocation()?></h6>
                        <p><?php echo $merged_products[$i]->getStartTime()?></p>
                        <p><?php echo $information[$i]?></p>
                    </div>
                    <div>
                        <h3 id="productprice <?php echo $i?>">
                            &euro;<?php echo ($merged_products[$i]->getPrice() * $amounts[$i])?></h3>
                    </div>
                </div>
                <br>
                <?php
                    }?>
                <div style="bottom:1; right:0; float: right">
                    <h2 id="totalprice">Total + VAT: &euro;<?php echo $totalPrice?></h2>
                </div>
                <button class="w-100 btn btn-success btn-lg" type="submit"
                    onclick="window.location.href = '/checkout'">Continue to Checkout</button>
                <button class="mt-5 w-50 btn btn-primary" type="button"
                    onclick="copyCartLink('<?php echo $hashedUserId?>')">Share Cart</button>
                <button class="btn btn-danger" type="button" onClick="update()">Availability</button>
            </div>

    </nav>
    <script src="/js/scriptfile.js"></script>
    <script>
    document.getElementById('twitter-button').addEventListener('click', function() {
        var url = encodeURIComponent(window.location.href);
        var text = encodeURIComponent(document.title);
        var shareUrl = 'https://twitter.com/intent/tweet?url=' + url + '&text=' + text;
        window.open(shareUrl, '_blank');
    });

    document.getElementById('facebook-button').addEventListener('click', function() {
        var url = encodeURIComponent(window.location.href);
        var shareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + url;
        window.open(shareUrl, '_blank');
    });
    </script>
</body>

</html>
<script>
    //this is only for testing I'll delete later on
    function update(){

        var userId = <?php if (isset($_SESSION["user_id"]) ){echo $_SESSION["user_id"];} else { echo 0;};?>;

        const data = {"userId": userId }
        fetch('/api/shoppingcart/updateAvailability', {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        })
            .then(response => response.json())
            .then(data => console.log(data))
            .catch(error => console.error(error));
    }
</script>
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

.navbar-brand {
    position: relative;
    display: inline-block;
}

.share {
    position: absolute;
    bottom: 0;
    right: 0;
    display: flex;
    flex-direction: row;
    align-items: center;
    margin-bottom: 10px;
}
#twitter-button {
    background-color: #1DA1F2; /* Twitter blue */
    color: white; 
}

#facebook-button {
    margin-left: 10px;
    margin-right: 10px;
    background-color: #4267B2; /* Facebook blue */
    color: white; 
}
</style>