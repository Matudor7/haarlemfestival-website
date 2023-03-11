<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../Services/eventService.php';
require __DIR__ . '/../Services/DanceService.php';

class DanceController extends Controller{
    public function index(){

        $eventService = new EventService();
        $events = $eventService->getAll();

        $danceService = new DanceService();
        $artists = $danceService->getAllArtists();

        require __DIR__ . '/../views/dance/index.php';

        //
    }

    public function danceDetailPage(){

        $eventService = new EventService();

        $events = $eventService->getAll();
        
        require __DIR__ . '/../views/dance/danceDetailPage.php';
    }
}

?>