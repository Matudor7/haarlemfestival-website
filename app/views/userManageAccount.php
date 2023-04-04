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
    <link rel="stylesheet" href="/yummyStyle.css" type="text/css">
</head>

<body>
    <?php
include __DIR__ . '/nav.php';
?>
    <div class="container-sm">
        <h1 class="my-4"> Manage Your Account </h1>
        <div>
            <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateInput();">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-elements">
                            <div class="mb-3">
                                <label for="userManageAccountEmailTextBox" class="form-label">Email address*</label>
                                <input type="email" class="form-control" id="userManageAccountEmailTextBox"
                                    name="userManageAccountEmailTextBox" placeholder="E-mail" required>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="userManageAccountUsernameTextBox" class="form-label">Username*</label>
                                    <input type="text" class="form-control" id="userManageAccountUsernameTextBox"
                                        name="userManageAccountUsernameTextBox" placeholder="Username" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="userManageAccountFirstNameTextBox" class="form-label">First
                                        Name*</label>
                                    <input type="text" class="form-control" id="userManageAccountFirstNameTextBox"
                                        name="userManageAccountFirstNameTextBox" placeholder="First Name" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="userManageAccountLastNameTextBox" class="form-label">Last Name*</label>
                                    <input type="text" class="form-control" id="userManageAccountLastNameTextBox"
                                        name="userManageAccountLastNameTextBox" placeholder="Last Name" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="userManageAccountPassword1TextBox" class="form-label">Password*</label>
                                    <input type="password" class="form-control" id="userManageAccountPassword1TextBox"
                                        name="userManageAccountPassword1TextBox" placeholder="Password" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="userManageAccountPassword2TextBox" class="form-label">Password
                                        Again*</label>
                                    <input type="password" class="form-control" id="userManageAccountPassword2TextBox"
                                        name="userManageAccountPassword2TextBox" placeholder="Password Again" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-5">
                        <div class="image-upload">
                            <div class="mb-3">
                                <img src="" class="img-thumbnail my-3" alt="User Profile Picture">
                            </div>
                            <div class="mb-3">
                                <label for="userManageAccountImageInput" class="form-label">User Profile Picture</label>
                                <input type="file" class="form-control" id="userManageAccountImageInput"
                                    name="userManageAccountImageInput" accept="image/png, image/jpg">
                            </div>
                            <p>Accepted input types: .png, .jpg
                            </p>
                        </div>
                    </div>
                </div>
                <p class="fw-bold">* marked fields are mandatory.</p>
                <p>Once you have updated your account information, we will send you a confirmation email to verify the
                    changes.
                </p>
                <button type="submit" class="btn btn-success mt-3" name="editbutton">Confirm Changes
                </button>
                <a href="/">
                    <button type="button" class="btn btn-danger mt-3">Cancel</button>
                </a>
            </form>
        </div>
    </div>

    <?php
include __DIR__ . '/footer.php';
?>

    <script>
    function validateInput() {
        if (document.getElementById('userManageAccountPassword1TextBox').value !== document.getElementById(
                'userManageAccountPassword2TextBox').value) {
            alert("Passwords do not match with each other, please try again.");
        }
        return true;
    }
    </script>
</body>

</html>