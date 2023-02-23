<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../Services/eventService.php';

class YummyController extends Controller{
    public function index(){
        $eventService = new EventService();

        $events = $eventService->getAll();
        
        require __DIR__ . '/../views/yummy/index.php';
    }

    public function details(){
        $eventService = new EventService();

        $events = $eventService->getAll();
        require __DIR__ . '/../views/yummy/details.php';
    }
}
?>