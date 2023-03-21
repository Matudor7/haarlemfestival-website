<?php
require __DIR__ . '/controller.php'; 
require __DIR__ . '/../Services/eventService.php';
require __DIR__ . '/../Services/walkingTourService.php';
require_once __DIR__ . '/../Models/WalkingTourModel.php';

class WalkingTourController extends Controller{
    
    public function index(){

        $eventService = new EventService();
        $events = $eventService->getAll();

        $walkingTourService = new WalkingTourService();
        $walkingTours = $walkingTourService->getAllWalkingTours();
        $prices = $walkingTourService->getTourPrices();
        $locations = $walkingTourService->getTourLocations();
        $timetables = $walkingTourService->getTourTimetable();
        //$languages = $walkingTourService->getTourLanguages();

        require __DIR__ . '/../views/walkingtour/index.php';
    }

    public function detailpage() {
        $eventService = new EventService();
        $events = $eventService->getAll();

        require __DIR__ . '/../views/walkingtour/walkingTourDetailPage.php';
    }
}

?>