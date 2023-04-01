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

        require __DIR__ . "/../views/admin/danceAdminManage.php";
    }
    public function danceAdminAdd()
    {
        $element = htmlspecialchars($_GET["type"], ENT_QUOTES, "UTF-8");
        $allMusicTypes = $this->danceService->getAllMusicTypes();

        require __DIR__ . "/../views/admin/danceAdminAdd.php";
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
        $danceLocationToEdit = new DanceLocation();  
        switch ($element) {
            case "Location":
            $danceLocationToEdit = $this->danceService->getDanceLocationById($_GET['id']); // get the dance location object from the service using the ID in the URL parameter
            break;
        }

        if(isset($_POST['editbutton'])){
            switch ($element) {
                case "Location":
                        $danceLocation = $this->danceService->getDanceLocationById($_GET['id']); 
                        $this->editLocationElement($danceLocation);   
                        header('Location: /adminDance');           
                    break;
                default:
                    require __DIR__ . "/../views/admin/danceAdminEdit.php";
                    break;
            }
        }
        require __DIR__ . "/../views/admin/danceAdminEdit.php";
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
}