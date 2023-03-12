<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<h1>Edit Event</h1>

<form action="" method="POST">
    <div class="mb-3" style="width: 10%">
        <label for="eventnametextbox" class="form-label">Event name</label>
        <input type="text" class="form-control" name="eventnametextbox" id="eventnametextbox" placeholder="Event Name" value=<?php echo $event->getName()?>>
    </div>
    <div class="mb-3" style="width: 50%">
        <label for="eventdesctextbox" class="form-label">Description</label>
        <textarea class="form-control" name="eventdesctextbox" id="eventdesctextbox" cols="20" rows="5" placeholder="Event Description"><?php echo $event->getDescription()?></textarea>
    </div>
    <div class="mb-3" style="width: 10%">
        <label for="eventstarttimecalendar" class="form-label">Start Time</label>
        <input type="date" class="form-control" name="eventstarttimecalendar" id="eventstarttimecalendar" value=<?php echo $event->getStartTime()?>>
    </div>
    <div class="mb-3" style="width: 10%">
        <label for="eventendtimecalendar" class="form-label">End Time</label>
        <input type="date" class="form-control" name="eventendtimecalendar" id="eventendtimecalendar" value=<?php echo $event->getEndTime()?>>
    </div>
    <div class="mb-3" style="width: 15%">
        <label for="eventinput" class="form-label">Image</label>
        <img id="eventimage">
        <input type="file" class="form-control" id="eventinput" name="eventinput" accept="image/png, image/jpg" onchange="updateFileInput() value=<?php echo $event->getImageUrl()?>">
    </div>
    <div>
        <button type="submit" class="btn btn-warning mt-5" name="editbutton" onclick="goBack()">Save Changes</button>
        <button type="button" class="btn btn-danger mt-5" onclick="goBack()">Cancel</button>
    </div>

    <script>
        function goBack(){
            window.location.href = "/admin/events";
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</form>
</body>
</html>