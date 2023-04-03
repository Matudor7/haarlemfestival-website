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
            case "Artist":
                $artist = $this->danceService->getArtistById($_GET['id']); 
                $this->danceService->deleteArtist($artist); 
                header('Location: /adminDance/danceAdminManage?type=Artist'); 
                break;
            default:
                header('Location: /adminDance'); 
        }
    }

    public function editelement()
    {
        $element = htmlspecialchars($_GET["type"], ENT_QUOTES, "UTF-8");  
        $danceLocationToEdit = new DanceLocation();  
        $artistToEdit = new ArtistModel();
        $allMusicTypes = $this->danceService->getAllMusicTypes();
        $artistMusicTypeIds= [];

        switch ($element) {
            case "Location":
                $danceLocationToEdit = $this->danceService->getDanceLocationById($_GET['id']); // get the dance location object from the service using the ID in the URL parameter
                break;
            case "Artist":
                $artistToEdit = $this->danceService->getArtistById($_GET['id']);
                $artistMusicTypes = $this->danceService->getMusicTypesByArtist($artistToEdit);
                foreach ($artistMusicTypes as $musicType) {
                    $artistMusicTypeIds[] = $musicType->getId();
                }
                break;
        }

        if(isset($_POST['editbutton'])){
            switch ($element) {
                case "Location":
                        $danceLocation = $this->danceService->getDanceLocationById($_GET['id']);
                        $downloadPath = $this->addPhoto('danceLocationImageInput', $_POST['danceLocationNameTextBox']);
                        $this->editLocationElement($danceLocation, $downloadPath);
                    break;
                case "Artist":
                        $artist = $this->danceService->getArtistById($_GET['id']); 
                        $this->editArtistElements($artist, $allMusicTypes);            
                    break;
                default:
                    require __DIR__ . "/../views/admin/danceAdminEdit.php";
                    break;
            }
        }
        require __DIR__ . "/../views/admin/danceAdminEdit.php";
    }

    function addPhoto($inputBoxName, $elementName){
        try {
            $imageUrl = $_FILES[$inputBoxName]['tmp_name'];
            $imageName = strtolower(htmlspecialchars(preg_replace('/[^a-zA-Z0-9]/s', '', $elementName)));
            $downloadPath = SITE_ROOT . '/media/dancePics/' . $imageName . '.png'; 
            move_uploaded_file($imageUrl, $downloadPath);
            $downloadPath = str_replace(SITE_ROOT, '', $downloadPath); // remove SITE_ROOT from $downloadPath
            return $downloadPath;
        } catch (Exception $e) {
            echo $e->getMessage();
            return ''; // return an empty string if an exception occurs
        }
    }
    

    function editLocationElement($oldLocation, $downloadPath){
        $newLocation = new DanceLocation();
        $newLocation->setDanceLocationName($_POST['danceLocationNameTextBox']);
        $newLocation->setDanceLocationStreet($_POST['danceLocationStreetTextBox']);
        $newLocation->setDanceLocationNumber($_POST['danceLocationNumberTextBox']);
        $newLocation->setDanceLocationPostcode($_POST['danceLocationPostcodeTextBox']);
        $newLocation->setDanceLocationCity($_POST['danceLocationCityTextBox']);
        $newLocation->setDanceLocationUrlToTheirSite($_POST['danceLocationUrlToTheirSiteTextBox']);
        $newLocation->setDanceLocationImageUrl($downloadPath);
       
        $this->danceService->editDanceLocation($oldLocation, $newLocation);        
    }

    function editArtistElements($oldArtist, $allMusicTypes){
        $newArtist = new Artistmodel();
        $newArtist->setName($_POST['danceArtistNameTextBox']);
        if ($_POST['danceArtistHasDetailPageDropdown'] === 'No') {
            $newArtist->setHasDetailPage(false);
        } else {
            $newArtist->setHasDetailPage(true);
        }
        $newArtist->setArtistHomepageImageUrl($_POST['danceArtistImageInput']);
        $this->danceService->editArtist($oldArtist, $newArtist);

        $selectedMusicTypes = [];
        foreach ($allMusicTypes as $musicType) {
            if (isset($_POST['musicType'.$musicType->getId()])) {
                $selectedMusicTypes[] = $_POST['musicType'.$musicType->getId()];
            }
        }
        $this->danceService->editArtistMusicTypes($newArtist, $selectedMusicTypes);

    }
}