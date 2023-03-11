<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <h1>Add Event</h1>

    <form action="POST">
        <div class="mb-3" style="width: 10%">
            <label for="eventnametextbox" class="form-label">Event name</label>
            <input type="text" class="form-control" id="eventnametextbox" placeholder="Event Name">
        </div>
        <div class="mb-3" style="width: 50%">
            <label for="eventdesctextbox" class="form-label">Description</label>
            <textarea class="form-control" id="eventdesctextbox" cols="20" rows="5" placeholder="Event Description"></textarea>
        </div>
        <div class="mb-3" style="width: 10%">
            <label for="eventstarttimecalendar" class="form-label">Start Time</label>
            <input type="date" class="form-control" id="eventstarttimecalendar">
        </div>
        <div class="mb-3" style="width: 10%">
            <label for="eventendtimecalendar" class="form-label">End Time</label>
            <input type="date" class="form-control" id="eventendtimecalendar">
        </div>
        <div class="mb-3" style="width: 15%">
            <label for="eventimage" class="form-label">Image</label>
            <input type="file" class="form-control" id="eventimage" accept="image/png, image/jpeg, image/jpg">
        </div>
        <div>
            <button type="button" class="btn btn-primary mt-5" onclick="addEvent()">Add Event</button>
            <button type="button" class="btn btn-danger mt-5" onclick="goBack()">Cancel</button>
        </div>
    </form>
    <script>
        function addEvent(){
            const eventNameTextbox = document.getElementById('eventnametextbox').value;
            const eventDescriptionTextbox = document.getElementById('eventdesctextbox').value;
            var eventStartTime = new Date(document.getElementById('eventstarttimecalendar').value);
            var eventEndTime = new Date(document.getElementById('eventendtimecalendar').value);
            const eventImage = document.getElementById('eventimage').value;

            //Display message if any input is ignored
            if(eventNameTextbox.trim() == '' || eventDescriptionTextbox.trim() == '' || !eventStartTime || !eventEndTime || !eventImage){
                window.confirm('Event form filled incorrectly. Please try again');
            }else{
                const eventData = 
                {
                    event_name: eventNameTextbox.trim(), 
                    event_urlRedirect: "/" + eventNameTextbox.replace(/[^a-zA-Z0-9]/g, '').toLowerCase().trim(), 
                    event_imageUrl: eventImage, 
                    event_description: eventDescriptionTextbox.trim(), 
                    event_startTime: eventStartTime.getFullYear() + "-" + (eventStartTime.getMonth() + 1).toString().padStart(2, '0') + "-" + eventStartTime.getDate().toString().padStart(2, '0'), 
                    event_endTime: eventEndTime.getFullYear() + "-" + (eventEndTime.getMonth() + 1).toString().padStart(2, '0') + "-" + eventEndTime.getDate().toString().padStart(2, '0')
                };
                console.log(eventData);
            }
        }

        function goBack(){
            window.location.href ="/admin/events";
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>