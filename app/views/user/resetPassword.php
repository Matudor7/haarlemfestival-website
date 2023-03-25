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

<body class="body"><br>
<h2> Please enter your email and we will send you a temporary Password</h2>
<form method="post" action="/user/resetPassword">
<input type="text" name="email" placeholder="email"><br><br>
<input id="sendPassword" type="submit" name="sendPassword" value="Send me a new Password"><br><br>
</form>

</div>
<?php
include __DIR__ . '/../footer.php';
?>

</body>

</html>