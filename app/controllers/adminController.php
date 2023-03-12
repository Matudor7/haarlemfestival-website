<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/festivalService.php';
require __DIR__ . '/../services/eventService.php';

class AdminController extends Controller{
    public function index(){
        $festivalService = new FestivalService();
        $eventService = new EventService();

        $festival = $festivalService->getFestival();
        $events = $eventService->getAll();
        
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
        require __DIR__ . '/../views/admin/addevent.php';
    }
}

?>