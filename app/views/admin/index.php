<!DOCTYPE html>
<!-- Tudor Nosca (678549) -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin start page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<?php
    require __DIR__ . '/../adminNavbar.php'
?>
<?php
foreach($festival as $f){
?>
<form action="" method="POST">
<label for="events">Event: </label>
<select name="events" id="<?php echo "events " . $f->getId()?>" onchange="updateField(<?php echo $f->getId()?>)">
    <?php foreach($this->events as $e){
    ?>
        <option value=<?php echo $e->getName()?> <?php if($e->getName() == $f->getEventName()) echo 'selected'?>><?php echo $e->getName()?></option>
    <?php
    };
    ?>
</select><br><br>
</form>
<?php
};
?>
</form>
    <script>
        function updateField(festivalId){
            const eventField = document.getElementById("events " + festivalId);
            console.log(eventField.value);

            const fieldData = {
                "event_name": eventField.value
            };

            fetch("http://localhost/api/festival?id=" + festivalId,{
                method: 'PATCH',
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(fieldData),
            })
            .then((response) => response.json())
            .then((data) => console.log(data))
            .catch((error) => console.error(error));

            window.location.href = "/admin";
        }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>