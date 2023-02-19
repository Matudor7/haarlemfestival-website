<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../Services/eventService.php';

class DanceController extends Controller{
    public function index(){

        $eventService = new EventService();

        $events = $eventService->getAll();

        require __DIR__ . '/../views/dance/index.php';
    }
}

?>