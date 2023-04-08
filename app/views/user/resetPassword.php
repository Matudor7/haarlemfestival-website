<?php //session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">

</head>

<body>
<?php
include __DIR__ . '/../nav.php';
?>

<body  class="text-center col-12"><br><br><br>
<h5> Please enter your email and we will send you a temporary Password</h5><br><br>
<form method="post" action="/user/resetPassword">
<input required type="email"  name="email" placeholder="Enter your email"><br><br>
<input id="sendPassword" type="submit" class="btn btn-success" name="sendPassword" value="Send me a new Password"><br><br>
</form>

</div>
<?php
include __DIR__ . '/../footer.php';
?>

</body>

</html>