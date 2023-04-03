<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <a href="/admin/users">
            <button type="button" class="my-3 btn btn-primary">Go Back</button>
        </a>
        <h1>Edit User</h1>
        <div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-1">
                        <img src="<?php echo $userToEdit->getUserPicURL() ?>" class="img-thumbnail my-3" alt="User Profile Picture">
                    </div>
                    <div class="col-2">
                        <label for="userAdminImageInput" class="form-label">User Profile Picture</label>
                        <input type="file" class="form-control" id="userAdminImageInput" name="userAdminImageInput"
                            accept="image/png, image/jpg">
                    </div>
                </div>
                <div class="mb-3" style="width: 10%">
                    <label for="userAdminUsernameTextBox" class="form-label">Username*</label>
                    <input type="text" class="form-control" id="userAdminUsernameTextBox"
                        name="userAdminUsernameTextBox" placeholder="Username" required
                        value="<?php echo $userToEdit->getUsername() ?>">
                </div>
                <div class="mb-3" style="width: 20%">
                    <label for="userAdminEmailTextBox" class="form-label">E-mail*</label>
                    <input type="text" class="form-control" id="userAdminEmailTextBox" name="userAdminEmailTextBox"
                        placeholder="Email" required value="<?php echo $userToEdit->getUserEmail() ?>">
                </div>
                <div class="mb-3" style="width: 20%">
                    <label for="userAdminFirstNameTextBox" class="form-label">First name*</label>
                    <input type="text" class="form-control" id="userAdminFirstNameTextBox"
                        name="userAdminFirstNameTextBox" placeholder="First name" required
                        value="<?php echo $userToEdit->getUserFirstName() ?>">
                </div>
                <div class="mb-3" style="width: 20%">
                    <label for="userAdminLastnameTextBox" class="form-label">Last name*</label>
                    <input type="text" class="form-control" id="userAdminLastnameTextBox"
                        name="userAdminLastnameTextBox" placeholder="Last name" required
                        value="<?php echo $userToEdit->getUserLastname() ?>">
                </div>
                <div class="mb-3" style="width: 20%">
                    <label for="userAdminUserTypeDropdown">User Type* </label>
                    <select name="userAdminUserTypeDropdown" id="userAdminUserTypeDropdown" required>
                        <?php foreach($allUserTypes as $userType) {?>
                        <option value="<?php echo $userType->getUserTypeId() ?>"
                            <?php if ($userType->getUserTypeId() == $userToEdit->getUserTypeId()) { echo "selected"; } ?>>
                            <?php echo $userType->getUserType() ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <p class="fw-bold">* marked fields are mandatory.</p>
                <button type="submit" class="btn btn-success mt-5" name="editbutton" onclick="editElement()">Edit User
                </button>
                <a href="/admin/users">
                    <button type="button" class="btn btn-danger mt-5">Cancel</button>
                </a>
        </div>
        </form>
    </div>

    <script>

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

</body>

</html>