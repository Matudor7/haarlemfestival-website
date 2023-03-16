<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../Services/eventService.php';
require __DIR__ . '/../Services/DanceService.php';

class DanceController extends Controller{
    public int $artistId = 0;

    public function index(){        
        $eventService = new EventService();
        $events = $eventService->getAll();

        $danceService = new DanceService();
        $artists = $danceService->getAllArtists();
        $danceLocations = $danceService->getAllDanceLocations();
        $danceFlashbacks = $danceService->getAllDanceFlashbacks();
        $danceEvents = $danceService->getAllDanceEvents();

        $extraNotes = []; // creating an empty array to hold the extra notes
        foreach ($danceEvents as $danceEvent) {
            $extraNotes[] = $danceEvent->getDanceEventExtraNote(); // add the event's extra note to the array
        }

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

    public function danceDetailPage(){
        $eventService = new EventService();
        $events = $eventService->getAll();
        
        require __DIR__ . '/../views/dance/danceDetailPage.php';
    }

    public function groupDanceEventsByDate($danceEvents){
        
    }
}

?>