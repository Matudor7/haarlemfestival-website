<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <?php
    require __DIR__ . '/../adminNavbar.php';
    ?>
    <div class="container-fluid">
        <h1>Manage Users</h1>
        <a href="/adminUsers/addUsers">
            <button class="btn btn-success my-3">Add New User</button>
        </a>
        <section>
            <table class="table" id="allUsersTable">
                <thead>
                    <tr>
                        <th scope="col">User ID</th>
                        <th scope="col">Profile Picture</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">User Type</th>
                        <th scope="col">Profile Picture URL</th>
                        <th scope="col">Registration Date</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allUsers as $user){?>
                    <tr>
                        <th scope="row"><?php echo $user->getUserId()?></th>
                        <td><img src="<?php echo $user->getUserPicURL()?>" class="img-fluid" alt="User Profile Photo"
                                style="max-height:30px;"></td>
                        <td><?php echo $user->getUsername()?></td>
                        <td><?php echo $user->getUserEmail()?></td>
                        <td><?php echo $user->getUserFirstName()?></td>
                        <td><?php echo $user->getUserLastName()?></td>
                        <td><?php echo $user->getUserTypeName2($user->getUserId()) ?></td>
                        <td><?php echo $user->getUserPicURL()?></td>
                        <td><?php echo $user->getUserRegistrationDate()->format('Y-m-d')?></td>
                        <td><button onclick="location.href='/admin/editUser?id=<?=$user->getUserId()?>'" type="button" class="btn btn-warning">Edit</button></td>
                        <td><button onclick="location.href='/admin/deleteUser?id=<?=$user->getUserId()?>'" type="button" class="btn btn-danger">Delete</button></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </div>
    <script>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>