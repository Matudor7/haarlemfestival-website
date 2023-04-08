<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add <?php echo $element ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<?php 
    function generateTheAddFormByElement($element, $allMusicTypes){

    switch ($element) {
        case 'Artist':
            $addFormHtml = generateArtistAddForm($allMusicTypes);
            break;
        case "MusicType":
            $addFormHtml = generateMusicTypeAddForm();
            break;
        case "Location":
            $addFormHtml = generateLocationAddForm();
            break;
        /*case 'Event':
            $tableHtml = $this->generateEventTable($danceEvents);
            break;*/
        default:
            $addFormHtml =
                "<p>There has been an error creating the Add Form. Please try again later.</p>";
            break;
    }
    return $addFormHtml;
}

function generateArtistAddForm($allMusicTypes) {

    $artistAddFormHtml = '
        <div class="mb-3" style="width: 20%">
            <label for="danceArtistNameTextBox" class="form-label">Artist Name*</label>
            <input type="text" class="form-control" id="danceArtistNameTextBox" name="danceArtistNameTextBox" placeholder="Artist Name" required>
        </div>
        <div class="mb-3" style="width: 20%">
            <label for="danceArtistHasDetailPageDropdown">Does the artist have a detail page?* </label>
            <select name="danceArtistHasDetailPageDropdown" id="danceArtistHasDetailPageDropdown" required>
                <option value="No">No</option>
                <option value="Yes">Yes</option>  
            </select>
        </div>
        <div class="mb-3" style="width: 20%">
        <p>Select the genres:*</p>';    
    foreach ($allMusicTypes as $musicType) {
        $artistAddFormHtml .= '
            <input type="checkbox" id="musicType' . $musicType->getId() . '" name="musicType' . $musicType->getId() . '" value="' . $musicType->getId() . '">
            <label for="musicType' . $musicType->getId() . '">' . $musicType->getMusicTypeName() . '</label><br>';
    }    
    $artistAddFormHtml .= '
        </div>
        <div class="mb-3" style="width: 15%">
            <label for="danceArtistImageInput" class="form-label">Artist Image*</label>
            <input type="file" class="form-control" id="danceArtistImageInput" name="danceArtistImageInput" accept="image/png, image/jpg" required>
        </div>
        <p class="fw-bold">* marked fields are mandatory.</p>';

    return $artistAddFormHtml;
}
function generateMusicTypeAddForm()
    {
        $musicTypeAddForm = '<div class="mb-3" style="width: 20%">
        <label for="danceMusicTypeNameTextBox" class="form-label">New Music Type Name*</label>
        <input type="text" class="form-control" id="danceMusicTypeNameTextBox" name="danceMusicTypeNameTextBox"
            placeholder="Music Type Name" required>
    </div>';

        return $musicTypeAddForm;
    }

function generateLocationAddForm()
    {
        $locationAddFormHtml = '
        <div class="mb-3" style="width: 20%">
        <label for="danceLocationNameTextBox" class="form-label">Location Name*</label>
        <input type="text" class="form-control" id="danceLocationNameTextBox" name="danceLocationNameTextBox"
            placeholder="Location Name" required>
    </div>
    <div class="mb-3" style="width: 20%">
        <label for="danceLocationStreetTextBox" class="form-label">Street*</label>
        <input type="text" class="form-control" id="danceLocationStreetTextBox"
            name="danceLocationStreetTextBox" placeholder="Street" required>
    </div>
    <div class="mb-3" style="width: 10%">
        <label for="danceLocationNumberTextBox" class="form-label">Number*</label>
        <input type="text" class="form-control" id="danceLocationNumberTextBox"
            name="danceLocationNumberTextBox" placeholder="Number" required>
    </div>
    <div class="mb-3" style="width: 10%">
        <label for="danceLocationPostcodeTextBox" class="form-label">Postcode*</label>
        <input type="text" class="form-control" id="danceLocationPostcodeTextBox"
            name="danceLocationPostcodeTextBox" placeholder="Postcode" required>
    </div>
    <div class="mb-3" style="width: 15%">
        <label for="danceLocationCityTextBox" class="form-label">City*</label>
        <input type="text" class="form-control" id="danceLocationCityTextBox" name="danceLocationCityTextBox"
            placeholder="City" required>
    </div>
    <div class="mb-3" style="width: 50%">
        <label for="danceLocationUrlToTheirSiteTextBox" class="form-label">URL to Their Site*</label>
        <input type="text" class="form-control" id="danceLocationUrlToTheirSiteTextBox"
            name="danceLocationUrlToTheirSiteTextBox" placeholder="URL to Their Site" required>
    </div>
    <div class="mb-3" style="width: 15%">
        <label for="danceLocationImageInput" class="form-label">Location Image*</label>
        <input type="file" class="form-control" id="danceLocationImageInput" name="danceLocationImageInput"
            accept="image/png, image/jpg" required>
    </div>
    <p class="fw-bold">* marked fields are mandatory.</p>';

        return $locationAddFormHtml;
    }
?>

<body>
    <div class="container-fluid">
        <a href="/adminDance">
            <button type="button" class="my-3 btn btn-primary">Go Back</button>
        </a>
        <h1>Add <?php echo $element ?></h1>

        <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateInput();">
            <div>
                <?php $addForm = generateTheAddFormByElement($element, $allMusicTypes); 
        echo $addForm ?>
                <button type="submit" class="btn btn-success mt-5" name="addbutton" onclick="addElement()">Add
                    <?php echo $element ?></button>
                <a href="/adminDance">
                    <button type="button" class="btn btn-danger mt-5">Cancel</button>
                </a>
            </div>
        </form>
    </div>

    <script>
    function validateInput() {
        if ('<?php echo $element ?>' === 'Location') {
            var locationNumber = document.getElementById('danceLocationNumberTextBox').value;
            if (!Number.isInteger(Number(locationNumber))) {
                alert("Please enter a valid NUMBER for the location number.");
                return false;
            }
        } else if ('<?php echo $element ?>' === 'Artist') {
            var selectedValues = [];
            var checkboxes = document.querySelectorAll('input[type="checkbox"][name^="musicType"]:checked');
            checkboxes.forEach(function(checkbox) {
                selectedValues.push(checkbox.value);
            });

            if (selectedValues.length === 0) {
                alert("Please select at least one music type for the artist.");
                return false;
            }
        }
        return true;
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>