<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Dance [Element Name]</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <?php
    require __DIR__ . '/../adminNavbar.php';
    ?>
    <div class="container-fluid">
        <h1>Manage Dance <?php echo $element ?>s</h1>

        <button class="btn btn-success my-3">Add New Dance <?php echo $element ?></button>

        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">[element id]</th>
                    <th scope="col">[element x]</th>
                    <th scope="col">[element x]</th>
                    <th scope="col">[element x]</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">[element id]</th>
                    <td>[element x]</td>
                    <td>[element x]</td>
                    <td>[element x]</td>
                    <td><button class="btn btn-warning">Edit</button></td>
                    <td><button class="btn btn-danger">Delete</button></td>
                </tr>
                <tr>
                    <th scope="row">[element id]</th>
                    <td>[element x]</td>
                    <td>[element x]</td>
                    <td>[element x]</td>
                    <td><button class="btn btn-warning">Edit</button></td>
                    <td><button class="btn btn-danger">Delete</button></td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>