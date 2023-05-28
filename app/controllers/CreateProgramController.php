<?php
require_once  __DIR__ . '/controller.php';
require_once  __DIR__ . '/../Services/eventService.php';

class CreateProgramController extends Controller{
    public function index(){
        $eventService = new EventService();

        $events = $eventService->getAll();
        
        require_once  __DIR__ . '/../views/program/index.php';
    }
}

?>