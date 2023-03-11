<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <?php
    require __DIR__ . '/../adminNavbar.php';
    ?>
    <h1>Events</h1>

    <?php foreach($events as $event){
        ?>
  <div class="row mb-2">
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4" style="margin-right:20%">
          <h3 class="mb-0"><?php echo $event->getName()?></h3>
          <p class="card-text"><?php echo $event->getDescription()?></p>
        </div>
        <div>
            <img src=<?php echo "/" . $event->getImageUrl()?> alt=<?php echo $event->getName()?> style="width: 30%; height:auto; float:right">
        </div>
      </div>
    </div>
  </div>
    <?php
    }
    ?>
    <button class="btn btn-success mt-3" onclick="goToAddEvent()">Add Event</button>
    
    <script>
      function goToAddEvent(){
        window.location.href = '/admin/addevent';
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>