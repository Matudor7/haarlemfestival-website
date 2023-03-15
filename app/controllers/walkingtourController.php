<?php
require __DIR__ . '/controller.php'; 
require __DIR__ . '/../Services/eventService.php';

class walkingtourController extends Controller{
    public function index(){

        $eventService = new EventService();
        $events = $eventService->getAll();

        require __DIR__ . '/../views/walkingtour/index.php';

    }
}

?>