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
include __DIR__ . '/../nav.php';
?>
    <?php
    require __DIR__ . '/../adminNavbar.php';
    ?>
    <div class="container-fluid">
        <h1>Manage Users</h1>
        <div class="row">
            <div class="col-1">
                <a href="/admin/addUser">
                    <button class="btn btn-success my-3">Add New User</button>
                </a>
            </div>
            <div class="col-3">
                <div class="input-group my-3">
                    <input type="search" class="form-control rounded"
                        placeholder="Search by username, email, firstname or lastname" aria-label="Search"
                        aria-describedby="search-addon" id="search-input" />
                    <button onclick="searchUsers()" type="button" class="btn btn-primary">Search</button>
                </div>
            </div>
            <div class="col-1 p-3">
                <div class="dropdown">
                    <a class="btn btn-info dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Sort By
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" onclick="location.href='/admin/users'">Earlier
                                Registeration Date</a></li>
                        <li><a class="dropdown-item"
                                onclick="location.href='/admin/users?sortBy=laterRegistrationDate'">Later Registeration
                                Date</a></li>
                        <li><a class="dropdown-item"
                                onclick="location.href='/admin/users?sortBy=usernameAlphabetical'">Username
                                Alphabetical</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-4 p-3">
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <h5 class="px-3 pt-1"> Filter By: </h5>
                    <button onclick="location.href='/admin/users'" type="button" class="btn btn-outline-primary">All
                        Users</button>
                    <button onclick="location.href='/admin/users?filter=admins'" type="button"
                        class="btn btn-outline-primary">Admins</button>
                    <button onclick="location.href='/admin/users?filter=employees'" type="button"
                        class="btn btn-outline-primary">Employees</button>
                    <button onclick="location.href='/admin/users?filter=customers'" type="button"
                        class="btn btn-outline-primary">Customers</button>
                </div>

            </div>
        </div>
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
                        <td><button onclick="location.href='/admin/editUser?id=<?=$user->getUserId()?>'" type="button"
                                class="btn btn-warning">Edit</button></td>
                        <td><button onclick="location.href='/admin/deleteUser?id=<?=$user->getUserId()?>'" type="button"
                                class="btn btn-danger">Delete</button></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </div>

    <script>
    function searchUsers() {
        var searchInput = document.getElementById("search-input").value;
        if (searchInput !== '') {
            location.href = '/admin/users?search=' + encodeURIComponent(
                searchInput); //this function is used to properly encode the search input value, 
            //which will ensure that special characters are encoded correctly and won't break the URL.
        } else {
            location.href = '/admin/users'
        }

    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>