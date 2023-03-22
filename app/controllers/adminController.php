<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/festivalService.php';
require __DIR__ . '/../services/eventService.php';
require __DIR__ . '/../services/DanceService.php';

class AdminController extends Controller{
    private $eventService;
    private $danceService;
    private $events;

    public function __construct() {
        $this->eventService = new EventService();
        $this->danceService = new DanceService();

        $this->events = $this->eventService->getAll();
    }
    public function index(){
        $festivalService = new FestivalService();
        $eventService = new EventService();

        $festival = $festivalService->getFestival();
        $events = $eventService->getAll();
        
        //This does not work as intended: changes all festival events at once
        if(isset($_POST['events'])){
            $festivalEvent = $festival[0];
            $newEvent = $eventService->getByName($_POST['events']);
            $festivalService->changeEvent($newEvent ->getName(), $festivalEvent->getEventName(), $newEvent->getId());
            echo "Selected event is: " . $_POST['events'];
        }
        
        require __DIR__ . '/../views/admin/index.php';
    }

    public function events(){
        //TODO: Use constructor to avoid duplicate code
        $eventService = new EventService();
        $events = $eventService->getAll();

        require __DIR__ . '/../views/admin/events.php';
    }
    function addevent(){
        if(isset($_POST['addbutton'])){
            try{
            
                //Get image URL from POST request, then download that image into /media/events
                $imageUrl = $_FILES['eventinput']['tmp_name'];
                
                $imageName = strtolower(htmlspecialchars(preg_replace('/[^a-zA-Z0-9]/s', '', $_POST['eventnametextbox'])));;
    
                $downloadPath = SITE_ROOT . '/media/events/' . $imageName . '.png'; // /media/events/event.png
    
                //Put the file from the image path to the download path
                move_uploaded_file($imageUrl, $downloadPath);
                }catch(Exception $e){
                    echo $e->getMessage();
                }
        }
        require __DIR__ . '/../views/admin/addevent.php';
    }

    function editevent(){
        $eventService = new EventService();

        $event = $eventService->getById($_GET['id']);

        if(isset($_POST['editbutton'])){
            $changedEvent = new Event();
            
            $changedEvent->setName($_POST['eventnametextbox']);
            $changedEvent->setDescription($_POST['eventdesctextbox']);
            $changedEvent->setStartTime($_POST['eventstarttimecalendar']);
            $changedEvent->setEndTime($_POST['eventendtimecalendar']);
            $changedEvent->setUrlRedirect("/" . strtolower(preg_replace('/[^a-zA-Z0-9]/s', '', $_POST['eventnametextbox'])));
            $changedEvent->setImageUrl($_POST['eventinput']);

            $eventService->updateEvent($event, $changedEvent);

            $event = $eventService->getById($_GET['id']);
        }

        require __DIR__ . '/../views/admin/editevent.php';
    }

    function deleteevent(){
        $eventService = new EventService();

        $event = $eventService->getById($_GET['id']);

        $eventService->deleteEvent($event);

        header('Location: /admin/events');
    }

    public function danceAdminIndex(){
        require __DIR__ . '/../views/admin/danceAdminIndex.php'; 
    }

    public function danceAdminManage(){
        $artists = $this->danceService->getAllArtists();
        $danceLocations = $this->danceService->getAllDanceLocations();
        $danceEvents = $this->danceService->getAllDanceEvents();

        foreach ($danceEvents as $danceEvent) {
            $date = $danceEvent->getDanceEventDateTime()->format('Y-m-d');
            if (!isset($danceEventsByDate[$date])) {
                $danceEventsByDate[$date] = [];
            }
        }

        $element = htmlspecialchars($_GET['type'], ENT_QUOTES, 'UTF-8');

        switch ($element) {
            case 'Artist':
                $tableHtml = $this->generateArtistTable($artists);
                break;
                case 'Location':
                    $tableHtml = $this->generateLocationTable($danceLocations);
                    break;
            default:
                // Handle invalid type
                break;
        }


        require __DIR__ . '/../views/admin/danceAdminManage.php'; 
    }

    function generateArtistTable($artists) {
        $tableHtml = '<table class="table">';
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
        $tableHtml .= '<tbody>';
    
        foreach ($artists as $artist) {
            $tableHtml .= '<tr>';
            $tableHtml .= '<td>' . $artist->getId() . '</td>';
            $tableHtml .= '<td><img src="' . $artist->getArtistHomepageImageUrl() . '" class="img-fluid" alt="' . $artist->getName() . ' Photo" style="max-height:30px;"></td>';
            $tableHtml .= '<td>' . $artist->getName() . '</td>';
            $tableHtml .= '<td>' . $artist->getArtistMusicTypes() . '</td>';
            $tableHtml .= '<td>' . ($artist->getHasDetailPage() ? 'Yes' : 'No') . '</td>';
            $tableHtml .= '<td>' . $artist->getArtistHomepageImageUrl() . '</td>';
            $tableHtml .= '<td><button class="btn btn-warning">Edit</button></td>';
            $tableHtml .= '<td><button class="btn btn-danger">Delete</button></td>';
            $tableHtml .= '</tr>';
        }
    
        $tableHtml .= '</tbody></table>';
        return $tableHtml;
    }

    function generateLocationTable($danceLocations){
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
        $tableHtml .= '<tbody>';
    
        foreach ($danceLocations as $location) {
            $tableHtml .= '<tr>';
            $tableHtml .= '<td>' . $location->getDanceLocationId() . '</td>';
            $tableHtml .= '<td><img src="' . $location->getDanceLocationImageUrl() . '" class="img-fluid" alt="' . $location->getDanceLocationName() . ' Photo" style="max-height:30px;"></td>';
            $tableHtml .= '<td>' . $location->getDanceLocationName() . '</td>';
            $tableHtml .= '<td>' . $location->getDanceLocationStreet() . '</td>';
            $tableHtml .= '<td>' . $location->getDanceLocationNumber() . '</td>';
            $tableHtml .= '<td>' . $location->getDanceLocationPostcode() . '</td>';
            $tableHtml .= '<td>' . $location->getDanceLocationCity() . '</td>';
            $tableHtml .= '<td>' . $location->getDanceLocationUrlToTheirSite() . '</td>';
            $tableHtml .= '<td>' . $location->getDanceLocationImageUrl() . '</td>';            
            $tableHtml .= '<td><button class="btn btn-warning">Edit</button></td>';
            $tableHtml .= '<td><button class="btn btn-danger">Delete</button></td>';
            $tableHtml .= '</tr>';
        }
    
        $tableHtml .= '</tbody></table>';
        return $tableHtml;
    }
}

?>