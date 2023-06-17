<?php //session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<?php
include __DIR__ . '/../nav.php';
?>
<div id="createUserDiv" class="text-center" style="min-height: 500px;">
    <br><br>
    <h2>Create new User</h2><br>
    <form method="POST" action="/user/registerNewUser">
        <input required type="text" name="username" placeholder="Username" id="usernameField"><br><br>
        <input required type="password" name="password" placeholder="Password" id="passwordField"><br><br>
        <input required type="text" name="firstname" placeholder="First name" id="nameField"><br><br>
        <input required type="text" name="lastname" placeholder="Last name" id="lastnameField"><br><br>
        <input required type="email" name="email" placeholder="Email" id="emailField"><br><br>
     <br>
    <div id="captchaElement" class="g-recaptcha" data-sitekey="6LfIsI8mAAAAAN0gIUKzN7G-D7rxcieciUvTMZ8B"></div>
        <br>
        <input id="createUserButton" class="btn btn-success" type="submit" name="singUp" value="Sing Up!"><br><br>
    </form>

</div>
<?php
include __DIR__ . '/../footer.php';
?>

</body>
</html>
<script>
    const usernameField = document.getElementById("usernameField")
    const nameField = document.getElementById("nameField")
    const passwordField = document.getElementById("passwordField")
    const lastnameField = document.getElementById("lastnameField")
    const emailField = document.getElementById("emailField")
function register(){
    const data = {
        "username": usernameField.value,
        "password": passwordField.value,
        "firstname": nameField.value,
        "lastname": lastnameField.value,
        "emailField": emailField.value};

    fetch('/user/registerNewUser', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
        .then(response => response.json())
        .then(data => showAlert(data.message, data.status))
        .catch(error => console.error(error));
}
    function showAlert(message, status) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${status}`;
        alertDiv.setAttribute('role', 'alert');
        alertDiv.innerText = message;

        const container = document.getElementById('createUserDiv');
        container.insertBefore(alertDiv, container.firstChild);
    }
</script>
<style>
    #captchaElement{
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>