<?php
require __DIR__ . "/controller.php";
require __DIR__ . "/../services/festivalService.php";
require __DIR__ . "/../services/eventService.php";
require __DIR__ . "/../services/DanceService.php";

class AdminDanceController extends Controller
{
    private $eventService;
    private $danceService;

    public function __construct()
    {
        $this->eventService = new EventService();
        $this->danceService = new DanceService();
    }
    public function index()
    {
        require __DIR__ . "/../views/admin/danceAdminIndex.php";
    }

    public function danceAdminManage()
    {
        $artists = $this->danceService->getAllArtists();
        $danceLocations = $this->danceService->getAllDanceLocations();
        $danceEvents = $this->danceService->getAllDanceEvents();
        $danceMusicTypes = $this->danceService->getAllMusicTypes();

        foreach ($danceEvents as $danceEvent) {  //organize dance events by date
            $date = $danceEvent->getDanceEventDateTime()->format("Y-m-d");
            if (!isset($danceEventsByDate[$date])) {
                $danceEventsByDate[$date] = [];
            }
        }
        // Get the type of element being managed
        $element = htmlspecialchars($_GET["type"], ENT_QUOTES, "UTF-8");
        
        switch ($element) { // Generate HTML table based on the type of element being managed
            case "Artist":
                $tableHtml = $this->generateArtistTable($artists);
                break;
            case "Location":
                $tableHtml = $this->generateLocationTable($danceLocations);
                break;
            case "Event":
                $tableHtml = $this->generateEventTable($danceEvents);
                break;
            default:
                $tableHtml =
                    "<p>There has been an error. Please try again later.</p>";
                break;
        }

        require __DIR__ . "/../views/admin/danceAdminManage.php";
    }

    function generateArtistTable($artists)
    {   
        $musicTypeLink = '/adminDance/danceAdminAdd?type=MusicType';
        $musicTypeButton = '<a href="'.$musicTypeLink.'">
                      <button type="button" class="btn btn-info">Add New Music Type</button>
                      </a>';

        $tableHtml = $musicTypeButton . '<table class="table">';
        $tableHtml .= '<thead class="thead-light">
                <tr>
                    <th scope="col">Artist Id </th>
                    <th scope="col">Artist Photo</th>
                    <th scope="col">Artist Name</th>
                    <th scope="col">Music Type</th>
                    <th scope="col">Detail Page</th>
                    <th scope="col">Image Url</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>';
        $tableHtml .= "<tbody>";

        foreach ($artists as $artist) {
            $tableHtml .= "<tr>";
            $tableHtml .= "<td>" . $artist->getId() . "</td>";
            $tableHtml .=
                '<td><img src="' .
                $artist->getArtistHomepageImageUrl() .
                '" class="img-fluid" alt="' .
                $artist->getName() .
                ' Photo" style="max-height:30px;"></td>';
            $tableHtml .= "<td>" . $artist->getName() . "</td>";
            $tableHtml .= "<td>" . $artist->getArtistMusicTypes() . "</td>";
            $tableHtml .=
                "<td>" . ($artist->getHasDetailPage() ? "Yes" : "No") . "</td>";
            $tableHtml .=
                "<td>" . $artist->getArtistHomepageImageUrl() . "</td>";
            $tableHtml .=
                '<td><button class="btn btn-warning">Edit</button></td>';
            $tableHtml .=
                '<td><button class="btn btn-danger">Delete</button></td>';
            $tableHtml .= "</tr>";
        }

        $tableHtml .= "</tbody></table>";
        return $tableHtml;
    }

    function generateLocationTable($danceLocations)
    {
        $tableHtml = '<table class="table">';
        $tableHtml .= '<thead class="thead-light">
                <tr>
                    <th scope="col">Location Id </th>
                    <th scope="col">Location Photo</th>
                    <th scope="col">Location Name</th>
                    <th scope="col">Street</th>
                    <th scope="col">Number</th>
                    <th scope="col">Postcode</th>
                    <th scope="col">City</th>
                    <th scope="col">URL to their site</th>
                    <th scope="col">Image URL</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>';
        $tableHtml .= "<tbody>";

        foreach ($danceLocations as $location) {
            $tableHtml .= "<tr>";
            $tableHtml .= "<td>" . $location->getDanceLocationId() . "</td>";
            $tableHtml .=
                '<td><img src="' .
                $location->getDanceLocationImageUrl() .
                '" class="img-fluid" alt="' .
                $location->getDanceLocationName() .
                ' Photo" style="max-height:30px;"></td>';
            $tableHtml .= "<td>" . $location->getDanceLocationName() . "</td>";
            $tableHtml .=
                "<td>" . $location->getDanceLocationStreet() . "</td>";
            $tableHtml .=
                "<td>" . $location->getDanceLocationNumber() . "</td>";
            $tableHtml .=
                "<td>" . $location->getDanceLocationPostcode() . "</td>";
            $tableHtml .= "<td>" . $location->getDanceLocationCity() . "</td>";
            $tableHtml .=
                "<td>" . $location->getDanceLocationUrlToTheirSite() . "</td>";
            $tableHtml .=
                "<td>" . $location->getDanceLocationImageUrl() . "</td>";
            $tableHtml .= '<td><button class="btn btn-warning" onclick="editElement(' . $location->getDanceLocationId() . ')">Edit</button></td>';
            $tableHtml .= '<td><button class="btn btn-danger" onclick="deleteElement(' . $location->getDanceLocationId() . ')">Delete</button></td>';
            $tableHtml .= "</tr>";
        }

        $tableHtml .= "</tbody></table>";
        return $tableHtml;
    }

    function generateEventTable($danceEvents)
    {
        $tableHtml = '<table class="table">';
        $tableHtml .= '<thead class="thead-light">
                <tr>
                    <th scope="col">Event Id </th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Location Name</th>
                    <th scope="col">Artists</th>
                    <th scope="col">Session</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Available Tickets</th>
                    <th scope="col">Price</th>
                    <th scope="col">Extra Note</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>';
        $tableHtml .= "<tbody>";

        foreach ($danceEvents as $event) {
            $tableHtml .= "<tr>";
            $tableHtml .= "<td>" . $event->getDanceEventId() . "</td>";
            $tableHtml .=
                "<td>" .
                $event->getDanceEventDateTime()->format("d-m-Y") .
                "</td>";
            $tableHtml .=
                "<td>" .
                $event->getDanceEventDateTime()->format("H:i") .
                "</td>";
            $tableHtml .= "<td>" . $event->getDanceLocationName() . "</td>";
            $tableHtml .= "<td>" . $event->getPerformingArtists() . "</td>";
            $tableHtml .= "<td>" . $event->getDanceSessionTypeName() . "</td>";
            $tableHtml .= "<td>" . $event->getDanceEventDuration() . "</td>";
            $tableHtml .=
                "<td>" . $event->getDanceEventAvailableTickets() . "</td>";
            $tableHtml .=
                "<td>" .
                number_format($event->getDanceEventPrice(), 2, ".", "") .
                "€" .
                "</td>";
            $tableHtml .= "<td>" . $event->getDanceEventExtraNote() . "</td>";
            $tableHtml .=
                '<td><button class="btn btn-warning">Edit</button></td>';
            $tableHtml .=
                '<td><button class="btn btn-danger">Delete</button></td>';
            $tableHtml .= "</tr>";
        }

        $tableHtml .= "</tbody></table>";
        return $tableHtml;
    }

    public function danceAdminAdd()
    {
        $element = htmlspecialchars($_GET["type"], ENT_QUOTES, "UTF-8");

        switch ($element) {
            /*case 'Artist':
                $tableHtml = $this->generateArtistTable($artists);
                break;*/
            case "MusicType":
                $addFormHtml = $this->generateMusicTypeAddForm();
                break;
            case "Location":
                $addFormHtml = $this->generateLocationAddForm();
                break;
            /*case 'Event':
                $tableHtml = $this->generateEventTable($danceEvents);
                break;*/
            default:
                $addFormHtml =
                    "<p>There has been an error creating the Add Form. Please try again later.</p>";
                break;
        }

        require __DIR__ . "/../views/admin/danceAdminAdd.php";
    }

    function generateLocationAddForm()
    {
        $locationAddFormHtml = '
        <div class="mb-3" style="width: 20%">
        <label for="danceLocationNameTextBox" class="form-label">Location Name*</label>
        <input type="text" class="form-control" id="danceLocationNameTextBox" name="danceLocationNameTextBox"
            placeholder="Location Name">
    </div>
    <div class="mb-3" style="width: 20%">
        <label for="danceLocationStreetTextBox" class="form-label">Street*</label>
        <input type="text" class="form-control" id="danceLocationStreetTextBox"
            name="danceLocationStreetTextBox" placeholder="Street">
    </div>
    <div class="mb-3" style="width: 10%">
        <label for="danceLocationNumberTextBox" class="form-label">Number*</label>
        <input type="text" class="form-control" id="danceLocationNumberTextBox"
            name="danceLocationNumberTextBox" placeholder="Number">
    </div>
    <div class="mb-3" style="width: 10%">
        <label for="danceLocationPostcodeTextBox" class="form-label">Postcode*</label>
        <input type="text" class="form-control" id="danceLocationPostcodeTextBox"
            name="danceLocationPostcodeTextBox" placeholder="Postcode">
    </div>
    <div class="mb-3" style="width: 15%">
        <label for="danceLocationCityTextBox" class="form-label">City*</label>
        <input type="text" class="form-control" id="danceLocationCityTextBox" name="danceLocationCityTextBox"
            placeholder="City">
    </div>
    <div class="mb-3" style="width: 50%">
        <label for="danceLocationUrlToTheirSiteTextBox" class="form-label">URL to Their Site*</label>
        <input type="text" class="form-control" id="danceLocationUrlToTheirSiteTextBox"
            name="danceLocationUrlToTheirSiteTextBox" placeholder="URL to Their Site">
    </div>
    <div class="mb-3" style="width: 15%">
        <label for="danceLocationImageInput" class="form-label">Location Image*</label>
        <input type="file" class="form-control" id="danceLocationImageInput" name="danceLocationImageInput"
            accept="image/png, image/jpg">
    </div>
    <p> * marked fields are mandatory. </p>';

        return $locationAddFormHtml;
    }

    function generateMusicTypeAddForm()
    {
        $musicTypeAddForm = '<div class="mb-3" style="width: 20%">
        <label for="danceMusicTypeNameTextBox" class="form-label">New Music Type Name*</label>
        <input type="text" class="form-control" id="danceMusicTypeNameTextBox" name="danceMusicTypeNameTextBox"
            placeholder="Music Type Name">
    </div>';

        return $musicTypeAddForm;
    }

    function deleteElement(){
        $element = htmlspecialchars($_GET["type"], ENT_QUOTES, "UTF-8");

        switch ($element) {
            case "Location":
                $danceLocation = $this->danceService->getDanceLocationById($_GET['id']); // get the dance location object from the service using the ID in the URL parameter
                $this->danceService->deleteDanceLocation($danceLocation); // deleting the location
                header('Location: /adminDance/danceAdminManage?type=Location'); // redirect the user back to the location manage page after deletion.
                break;
            default:
                header('Location: /adminDance'); 
        }
    }

    public function editelement()
    {
        $element = htmlspecialchars($_GET["type"], ENT_QUOTES, "UTF-8"); 
        $editFormHtml = $this->generateEditForms($element);

        if(isset($_POST['editbutton'])){
            switch ($element) {
                case "Location":
                    if (!is_numeric($_POST['danceLocationNumberTextBox'])) {
                        echo '<script>alert("Please enter a valid integer for the location number.");</script>';
                        require __DIR__ . "/../views/admin/danceAdminEdit.php";
                        return; // Stop the function execution
                    }else{$danceLocation = $this->danceService->getDanceLocationById($_GET['id']); // get the dance location object from the service using the ID in the URL parameter
                        $this->editLocationElement($danceLocation);}                    
                    break;
                default:
                    $editFormHtml =
                        "<p>There has been an error creating the Edit Form. Please try again later.</p>";
                    break;
            }
        }
        require __DIR__ . "/../views/admin/danceAdminEdit.php";
    }

    function generateEditForms($element){
        $editFormHtml = ''; // set a default value for the variable
        switch ($element) {
            case "Location":
                $danceLocation = $this->danceService->getDanceLocationById($_GET['id']); // get the dance location object from the service using the ID in the URL parameter
                $editFormHtml = $this->generateLocationEditForm($danceLocation);
                break;
            default:
                $editFormHtml =
                    "<p>There has been an error creating the Edit Form. Please try again later.</p>";
                break;
        }
        return $editFormHtml; // return the $editFormHtml variable
    }    

    function editLocationElement($oldLocation){
        $newLocation = new DanceLocation();
        $newLocation->setDanceLocationName($_POST['danceLocationNameTextBox']);
        $newLocation->setDanceLocationStreet($_POST['danceLocationStreetTextBox']);
        $newLocation->setDanceLocationNumber($_POST['danceLocationNumberTextBox']);
        $newLocation->setDanceLocationPostcode($_POST['danceLocationPostcodeTextBox']);
        $newLocation->setDanceLocationCity($_POST['danceLocationCityTextBox']);
        $newLocation->setDanceLocationUrlToTheirSite($_POST['danceLocationUrlToTheirSiteTextBox']);
        $newLocation->setDanceLocationImageUrl($_POST['danceLocationImageInput']);
       
        $this->danceService->editDanceLocation($oldLocation, $newLocation);
        
    }

    function generateLocationEditForm($location){
        $locationEditForm = '
        <div class="mb-3" style="width: 20%">
        <label for="danceLocationNameTextBox" class="form-label">Location Name*</label>
        <input type="text" class="form-control" id="danceLocationNameTextBox" name="danceLocationNameTextBox"
            placeholder="Location Name" value='. $location->getDanceLocationName() . '>
    </div>
    <div class="mb-3" style="width: 20%">
        <label for="danceLocationStreetTextBox" class="form-label">Street*</label>
        <input type="text" class="form-control" id="danceLocationStreetTextBox"
            name="danceLocationStreetTextBox" placeholder="Street" value='. $location->getDanceLocationStreet() . '>
    </div>
    <div class="mb-3" style="width: 10%">
        <label for="danceLocationNumberTextBox" class="form-label">Number*</label>
        <input type="text" class="form-control" id="danceLocationNumberTextBox"
            name="danceLocationNumberTextBox" placeholder="Number" value='. $location->getDanceLocationNumber() . '>
    </div>
    <div class="mb-3" style="width: 10%">
        <label for="danceLocationPostcodeTextBox" class="form-label">Postcode*</label>
        <input type="text" class="form-control" id="danceLocationPostcodeTextBox"
            name="danceLocationPostcodeTextBox" placeholder="Postcode" value='. $location->getDanceLocationPostcode() . '>
    </div>
    <div class="mb-3" style="width: 15%">
        <label for="danceLocationCityTextBox" class="form-label">City*</label>
        <input type="text" class="form-control" id="danceLocationCityTextBox" name="danceLocationCityTextBox"
            placeholder="City" value='. $location->getDanceLocationCity() . '>
    </div>
    <div class="mb-3" style="width: 50%">
        <label for="danceLocationUrlToTheirSiteTextBox" class="form-label">URL to Their Site*</label>
        <input type="text" class="form-control" id="danceLocationUrlToTheirSiteTextBox"
            name="danceLocationUrlToTheirSiteTextBox" placeholder="URL to Their Site"  value='. $location->getDanceLocationUrlToTheirSite() . '>
    </div>
    <div class="mb-3" style="width: 15%">
        <label for="danceLocationImageInput" class="form-label">Location Image*</label>
        <input type="file" class="form-control" id="danceLocationImageInput" name="danceLocationImageInput"
            accept="image/png, image/jpg">
    </div>
    <p> * marked fields are mandatory. </p>';

        return $locationEditForm;
    }
    
}