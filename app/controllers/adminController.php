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
        
        require __DIR__ . '/../views/admin/index.php';
    }
}

?>