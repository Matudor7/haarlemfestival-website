<?php
session_start();
require_once __DIR__ . "/controller.php";
require_once __DIR__ . "/../services/DanceService.php";

class AdminDanceController extends Controller
{
    private $danceService;

    public function __construct()
    {
        $this->danceService = new DanceService();
    }
    public function index()
    {
        if ($this->checkRole()) {
            require __DIR__ . "/../views/admin/danceAdminIndex.php";
        } else {
            header('Location: /');
        }
    }


    public function danceAdminManage()
    {    
        if ($this->checkRole()) {
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
        } else {
            header('Location: /');
        }         
        
    }
    public function danceAdminAdd()
    {
        $element = htmlspecialchars($_GET["type"], ENT_QUOTES, "UTF-8");
        $allMusicTypes = $this->danceService->getAllMusicTypes();
        $allDanceLocations = $this->danceService->getAllDanceLocations();
        $allArtists =  $this->danceService->getAllArtists();
        $allSessions =  $this->danceService->getAllDanceSessions();

        if(isset($_POST['addbutton'])){
            switch ($element) {
                case "Location":
                    $downloadPath = $this->addPhoto('danceLocationImageInput', $_POST['danceLocationNameTextBox']);
                    $this->addDanceLocationElement($downloadPath); // get the dance location object from the service using the ID in the URL parameter
                    break;   
                case "MusicType":                    
                    $this->addMusicTypeElement();
                    break;   
                case "Artist":                    
                    $downloadPath = $this->addPhoto('danceArtistImageInput', $_POST['danceArtistNameTextBox']);
                    $this->addDanceArtistElement($downloadPath, $allMusicTypes);
                    break;  
                case "Event":  
                    $this->addDanceEventElement($allArtists);
                    break;      
            }
        }

        require __DIR__ . "/../views/admin/danceAdminAdd.php";
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

    function addDanceLocationElement($downloadPath){
        $newLocation = new DanceLocation();
        $newLocation->setDanceLocationName($_POST['danceLocationNameTextBox']);
        $newLocation->setDanceLocationStreet($_POST['danceLocationStreetTextBox']);
        $newLocation->setDanceLocationNumber($_POST['danceLocationNumberTextBox']);
        $newLocation->setDanceLocationPostcode($_POST['danceLocationPostcodeTextBox']);
        $newLocation->setDanceLocationCity($_POST['danceLocationCityTextBox']);
        $newLocation->setDanceLocationUrlToTheirSite($_POST['danceLocationUrlToTheirSiteTextBox']);
        $newLocation->setDanceLocationImageUrl($downloadPath);
       
        $this->danceService->insertDanceLocation($newLocation);  
    }

    function addMusicTypeElement(){
        $musicType = new MusicType();
        $musicType->setMusicTypeName($_POST['danceMusicTypeNameTextBox']);    
        $this->danceService->insertMusicType($musicType);
    }

    function addDanceArtistElement($downloadPath, $allMusicTypes){
        $newArtist = new Artistmodel();
        if ($_POST['danceArtistHasDetailPageDropdown'] == "Yes") {
            $hasDetailPage = true;
        } else {
            $hasDetailPage = false;
        }
        
        $newArtist->setName($_POST['danceArtistNameTextBox']);
        $newArtist->setHasDetailPAge($hasDetailPage);
        $newArtist->setArtistHomepageImageUrl($downloadPath);
        $danceArtistId = $this->danceService->insertArtist($newArtist);
        
        $selectedMusicTypes = [];
        foreach ($allMusicTypes as $musicType) {
            if (isset($_POST['musicType'.$musicType->getId()])) {
                $selectedMusicTypes[] = $_POST['musicType'.$musicType->getId()];
            }
        }
        $this->addMusicTypesForNewArtist($selectedMusicTypes, $danceArtistId);
    }

    function addMusicTypesForNewArtist($selectedMusicTypes, $artistId){
        $musicTypes = [];

        foreach($selectedMusicTypes as $musicTypeId){
            $musicType = $this->danceService->getMusicTypeById($musicTypeId);
            array_push($musicTypes, $musicType);
        }
        
        foreach ($musicTypes as $musicType){
            $this->danceService->insertMusicTypeForArtist($artistId, $musicType);   
        }
    }
    function addDanceEventElement($allArtists){
        $newEvent = new DanceEvent();

        $dateString = $_POST['danceEventDateCalendar'];
        $dateObj = DateTime::createFromFormat('Y-m-d', $dateString);
        $newEvent->setDanceEventDate($dateObj);
        $timeString = $_POST['danceEventTime'];
        $timeObj = DateTime::createFromFormat('H:i', $timeString);
        $newEvent->setDanceEventTime($timeObj);

        $newEvent->setDanceLocationId($_POST['danceEventLocationDropDown']);
        $newEvent->setDanceSessionTypeId($_POST['danceEventSessionDropDown']);
        $newEvent->setDanceEventDuration($_POST['danceEventDurationTextBox']);
        $newEvent->setDanceEventAvailableTickets($_POST['danceEventAvailableTicketsTextBox']);
        $newEvent->setDanceEventPrice($_POST['danceEventPriceTextBox']);

        $eventNote = empty($_POST['danceEventExtraNoteTextBox']) ? '' : $_POST['danceEventExtraNoteTextBox'];

        $newEvent->setDanceEventExtraNote($eventNote);


        $newEventId = $this->danceService->insertDanceEvent($newEvent);
        
        $selectedArtists = [];
        foreach ($allArtists as $artist) {
            if (isset($_POST['artist'.$artist->getId()])) {
                $selectedArtists[] = $_POST['artist'.$artist->getId()];
            }
        }
        $this->addArtistsForNewEvent($selectedArtists, $newEventId);
    }

    function addArtistsForNewEvent($selectedArtists, $eventId){
        $artists = [];

        foreach($selectedArtists as $artistId){
            $artist = $this->danceService->getArtistById($artistId);
            array_push($artists, $artist);
        }
        
        foreach ($artists as $artist){
            $this->danceService->insertPerformingArtistsToNewEvent($eventId, $artist);   
        }
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
            case "Event":
                $event = $this->danceService->getEventById($_GET['id']); 
                $this->danceService->deleteEvent($event); 
                header('Location: /adminDance/danceAdminManage?type=Event'); 
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
        $eventToEdit = new DanceEvent();
        $allMusicTypes = $this->danceService->getAllMusicTypes();
        $allArtists = $this->danceService->getAllArtists();
        $allSessions =  $this->danceService->getAllDanceSessions();
        $allDanceLocations = $this->danceService->getAllDanceLocations();
        $artistMusicTypeIds= [];
        $artistIds = [];

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
            case "Event":
                $eventToEdit = $this->danceService->getEventById($_GET['id']);
                $eventArtists = $this->danceService->getArtistsByEvent($eventToEdit);
                foreach ($eventArtists as $artist) {
                    $artistIds[] = $artist->getId();
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
                        $downloadPath = $this->addPhoto('danceArtistImageInput', $_POST['danceArtistNameTextBox']);
                        $this->editArtistElements($artist, $allMusicTypes, $downloadPath);            
                    break;
                case "Event":
                        $event = $this->danceService->getEventById($_GET['id']);                         
                        $this->editEventElements($event, $allArtists);            
                    break;
                default:
                    require __DIR__ . "/../views/admin/danceAdminEdit.php";
                    break;
            }
        }
        require __DIR__ . "/../views/admin/danceAdminEdit.php";
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

    function editArtistElements($oldArtist, $allMusicTypes, $downloadPath){
        $newArtist = new Artistmodel();
        $newArtist->setName($_POST['danceArtistNameTextBox']);
        if ($_POST['danceArtistHasDetailPageDropdown'] === 'No') {
            $newArtist->setHasDetailPage(false);
        } else {
            $newArtist->setHasDetailPage(true);
        }
        $newArtist->setArtistHomepageImageUrl($downloadPath);
        $this->danceService->editArtist($oldArtist, $newArtist);

        $selectedMusicTypes = [];
        foreach ($allMusicTypes as $musicType) {
            if (isset($_POST['musicType'.$musicType->getId()])) {
                $selectedMusicTypes[] = $_POST['musicType'.$musicType->getId()];
            }
        }
        $this->danceService->editArtistMusicTypes($newArtist, $selectedMusicTypes);
    }

    function editEventElements($oldEvent, $allArtists){
        $newEvent = new DanceEvent();

        $dateString = $_POST['danceEventDateCalendar'];
        $dateObj = DateTime::createFromFormat('Y-m-d', $dateString);
        $newEvent->setDanceEventDate($dateObj);
        $timeString = $_POST['danceEventTime'];
        $timeObj = DateTime::createFromFormat('H:i', $timeString);
        $newEvent->setDanceEventTime($timeObj);

        $newEvent->setDanceLocationId($_POST['danceEventLocationDropDown']);
        $newEvent->setDanceSessionTypeId($_POST['danceEventSessionDropDown']);
        $newEvent->setDanceEventDuration($_POST['danceEventDurationTextBox']);
        $newEvent->setDanceEventAvailableTickets($_POST['danceEventAvailableTicketsTextBox']);
        $newEvent->setDanceEventPrice($_POST['danceEventPriceTextBox']);
        $eventNote = empty($_POST['danceEventExtraNoteTextBox']) ? '' : $_POST['danceEventExtraNoteTextBox'];
        $newEvent->setDanceEventExtraNote($eventNote);

        $this->danceService->editEvent($oldEvent, $newEvent);

        $selectedArtists = [];
        foreach ($allArtists as $artist) {
            if (isset($_POST['artist'.$artist->getId()])) {
                $selectedArtists[] = $_POST['artist'.$artist->getId()];
            }
        }
        $this->danceService->editEventArtists($newEvent, $selectedArtists);
    }

    function checkRole(){
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 2){
            return true;
        }
        return false;
    }
}