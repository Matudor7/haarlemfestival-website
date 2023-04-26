<?php
session_start();
require __DIR__ . '/controller.php';
require __DIR__ . '/../Services/walkingTourService.php';
require_once __DIR__ . '/../Models/WalkingTourModel.php';
require_once __DIR__ . '/../Models/WalkingTourContentModel.php';

class WalkingTourController extends Controller{

    private $walkingTourService;

    function __construct(){
        $this->walkingTourService = new WalkingTourService();
}
    public function index(){
        require __DIR__ . '/navbarRequirements.php';
        require_once __DIR__ . '/../Services/eventService.php';
        $eventService = new EventService();
        $thisEvent = $eventService->getByName("WalkingTour!");

        require_once __DIR__ . '/../Services/productService.php';
        $productService = new ProductService();
        $tickets = $productService->getByEventType($thisEvent->getId());



        $walkingTours = $this->walkingTourService->getAllWalkingTours();
        $prices = $this->walkingTourService->getTourPrices();
        $locations = $this->walkingTourService->getTourLocations();
        $timetables = $this->walkingTourService->getTourTimetable();
        $languages = $this->walkingTourService->getTourLanguages();
        $allContent = $this->getAllContent();


        require __DIR__ . '/../views/walkingtour/index.php';
        require __DIR__ .'/../views/buyTicketForm.php';

    }
    public function getContent(string $sectionName){
        return $this->walkingTourService->getContentByElement($sectionName);
    }

    public function getAllContent(){
        return $this->walkingTourService->getAllWalkingTourContent();
    }
}

?>