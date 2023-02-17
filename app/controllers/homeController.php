<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../Services/eventService.php';

class HomeController extends Controller{
    public function index(){
        $eventService = new EventService();

        $danceEvent = $eventService->getByName('dance');

        echo $danceEvent->getUrlRedirect();
        
        require __DIR__ . '/../views/homepage/index.php';
    }
}

?>