<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../Services/eventService.php';
require __DIR__ . '/../Services/DanceService.php';
require __DIR__ . '/../Services/DanceDetailPageService.php';

class DanceController extends Controller{
    private $eventService;
    private $danceService;
    private $danceDetailPageService;

    public function __construct() {
        $this->eventService = new EventService();
        $this->danceService = new DanceService(); 
        $this->danceDetailPageService = new DanceDetailPageService(); 
    }
    public int $artistId = 0;

    public function index(){        
        $events = $this->eventService->getAll();
        $artists = $this->danceService->getAllArtists();
        $danceLocations = $this->danceService->getAllDanceLocations();
        $danceEvents = $this->danceService->getAllDanceEvents();
        $danceFlashbacks = $this->danceService->getAllDanceFlashbacks();
        
        $danceEventsByDate = [];
        foreach ($danceEvents as $danceEvent) {
            $date = $danceEvent->getDanceEventDateTime()->format('Y-m-d');
            if (!isset($danceEventsByDate[$date])) {
                $danceEventsByDate[$date] = [];
            }
            $danceEventsByDate[$date][] = $danceEvent;
        }
        require __DIR__ . '/../views/dance/index.php';
    }

    public function detail(){
        $events = $this->eventService->getAll();
        $artist_id = filter_input(INPUT_GET, 'artist_id', FILTER_SANITIZE_NUMBER_INT);
        try {
            $artist = $this->danceService->getArtistById($artist_id);             

            if ($artist->getHasDetailPage()) {
                $html =  $this->danceDetailPageService->getDanceDetailPageContentById($artist->getId());
                $danceEventsByArtistId = $this->danceDetailPageService->getDanceEventsByArtistIdFromRepository($artist_id);

                foreach ($danceEventsByArtistId as $danceEvent) {
                    $date = $danceEvent->getDanceEventDateTime()->format('Y-m-d');
                    if (!isset($danceEventsByDate[$date])) {
                        $danceEventsByDate[$date] = [];
                    }
                    $danceEventsByDate[$date][] = $danceEvent;
                }

                require __DIR__ . '/../views/dance/danceDetailPage.php';
            } else {
                throw new Exception("This artist does not have a detail page yet. Please check again later.");
            }            

        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }

}

?>