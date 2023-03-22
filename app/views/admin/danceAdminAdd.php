<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <a href="/admin/danceAdminIndex">
            <button type="button" class="my-3 btn btn-primary">Go Back</button>
        </a>
        <h1>Add [Element Name]</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3" style="width: 20%">
                <label for="danceLocationNameTextBox" class="form-label">Location Name</label>
                <input type="text" class="form-control" id="danceLocationNameTextBox" name="danceLocationNameTextBox"
                    placeholder="Location Name">
            </div>
            <div class="mb-3" style="width: 20%">
                <label for="danceLocationStreetTextBox" class="form-label">Street</label>
                <input type="text" class="form-control" id="danceLocationStreetTextBox"
                    name="danceLocationStreetTextBox" placeholder="Street">
            </div>
            <div class="mb-3" style="width: 10%">
                <label for="danceLocationNumberTextBox" class="form-label">Number</label>
                <input type="text" class="form-control" id="danceLocationNumberTextBox"
                    name="danceLocationNumberTextBox" placeholder="Number">
            </div>
            <div class="mb-3" style="width: 10%">
                <label for="danceLocationPostcodeTextBox" class="form-label">Postcode</label>
                <input type="text" class="form-control" id="danceLocationPostcodeTextBox"
                    name="danceLocationPostcodeTextBox" placeholder="Postcode">
            </div>
            <div class="mb-3" style="width: 15%">
                <label for="danceLocationCityTextBox" class="form-label">City</label>
                <input type="text" class="form-control" id="danceLocationCityTextBox" name="danceLocationCityTextBox"
                    placeholder="City">
            </div>
            <div class="mb-3" style="width: 50%">
                <label for="danceLocationUrlToTheirSiteTextBox" class="form-label">URL to Their Site</label>
                <input type="text" class="form-control" id="danceLocationUrlToTheirSiteTextBox"
                    name="danceLocationUrlToTheirSiteTextBox" placeholder="URL to Their Site">
            </div>
            <div class="mb-3" style="width: 15%">
                <label for="danceLocationImageInput" class="form-label">Location Image</label>
                <input type="file" class="form-control" id="danceLocationImageInput" name="danceLocationImageInput"
                    accept="image/png, image/jpg">
            </div>
            <div>
                <button type="submit" class="btn btn-success mt-5" name="addbutton" onclick="addEvent()">Add [Element
                    Name]</button>
                <a href="/admin/danceAdminIndex">
                    <button type="button" class="btn btn-danger mt-5">Cancel</button>
                </a>
            </div>
        </form>
    </div>
    <script>
    /*function addEvent(){
            const eventNameTextbox = document.getElementById('eventnametextbox').value;
            const eventDescriptionTextbox = document.getElementById('eventdesctextbox').value;
            var eventStartTime = new Date(document.getElementById('eventstarttimecalendar').value);
            var eventEndTime = new Date(document.getElementById('eventendtimecalendar').value);
            const eventInput = document.getElementById('eventinput');


            //Display message if any input is ignored
            if(eventNameTextbox.trim() == '' || eventDescriptionTextbox.trim() == '' || !eventStartTime || !eventEndTime || !eventinput){
                window.confirm('Event form filled incorrectly. Please try again');
            }else{
                const eventData = 
                {
                    event_name: eventNameTextbox.trim(), 
                    event_urlRedirect: "/" + eventNameTextbox.replace(/[^a-zA-Z0-9]/g, '').toLowerCase().trim(), 
                    event_imageUrl: eventInput.value,
                    event_description: eventDescriptionTextbox.trim(), 
                    event_startTime: eventStartTime.getFullYear() + "-" + (eventStartTime.getMonth() + 1).toString().padStart(2, '0') + "-" + eventStartTime.getDate().toString().padStart(2, '0'), 
                    event_endTime: eventEndTime.getFullYear() + "-" + (eventEndTime.getMonth() + 1).toString().padStart(2, '0') + "-" + eventEndTime.getDate().toString().padStart(2, '0')
                };
                console.log(eventData);

                fetch("http://localhost/api/events",{
                    method: 'POST',
                    headers: {'Content-Type' : 'application/json',},
                    body: JSON.stringify(eventData),
                })
                //.then(response => {goBack()})
                .catch((err) => {console.error('Error: ', err);});
            }
        }

        function goBack(){
            window.location.href ="/admin/danceAdminManage";
        }*/
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>