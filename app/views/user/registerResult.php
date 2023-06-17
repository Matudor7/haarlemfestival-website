<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<?php include __DIR__ . '/../nav.php';?>
<div class="alert alert-<?=$response['status']?> mt-5 text-center" role="alert">
    <h4 class="alert-heading"><?php echo $response['header'] ?></h4>
    <p><?php echo $response['message'] ?></p>
    <hr>
    <button type="button" class="btn btn-warning rounded-pill mx-3 px-3 mt-1"
            onClick="location.href='/user/registerNewUser'">Try again</button>
    <button type="button" class="btn btn-success rounded-pill mx-3 px-3 mt-1"
            onClick="location.href='/login'">Go to Login</button>
</div>
<?php include __DIR__ . '/../footer.php';?>
</body>
</html>

