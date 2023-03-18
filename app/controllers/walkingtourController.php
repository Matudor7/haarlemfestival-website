<?php
require __DIR__ . '/controller.php'; 
require __DIR__ . '/../Services/eventService.php';
require __DIR__ . '/../Services/walkinTourService.php';

class walkingtourController extends Controller{
    public function index(){

        $eventService = new EventService();
        $events = $eventService->getAll();

        $walkinTourService = new WalkingTourService();
        $walkingTours = $walkinTourService->getAllWalkingTours();

        require __DIR__ . '/../views/walkingtour/index.php';
    }

    public function DetailPage() {
        $eventService = new EventService();
        $walkinTourService = new WalkingTourService();
        $events = $eventService->getAll();
        
        require __DIR__ . '/../views/walkingtour/walkingTourDetailPage.php';
    }
}

?>