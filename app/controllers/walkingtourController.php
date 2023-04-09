<?php
require __DIR__ . '/controller.php'; 
require __DIR__ . '/../Services/eventService.php';
require __DIR__ . '/../Services/walkingTourService.php';
require_once __DIR__ . '/../Models/WalkingTourModel.php';
require __DIR__ . '/../Services/productService.php';
require __DIR__ . '/../Services/shoppingCartService.php';

class WalkingTourController extends Controller{

    private $eventService;
    private $walkingTourService;
    private $productService;

    function __construct(){
        $this->eventService = new EventService();
        $this->walkingTourService = new WalkingTourService();
        $this->productService = new ProductService();
}
    public function index(){

        $events = $this->eventService->getAll();
        $thisEvent = $this->eventService->getByName("Walking Tour!");

        $walkingTours = $this->walkingTourService->getAllWalkingTours();
        $prices = $this->walkingTourService->getTourPrices();
        $locations = $this->walkingTourService->getTourLocations();
        $timetables = $this->walkingTourService->getTourTimetable();
        $languages = $this->walkingTourService->getTourLanguages();


        $tickets = $this->productService->getByEventType($thisEvent->getId());

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            selectTicket();
        }

        require __DIR__ . '/../views/walkingtour/index.php';
        require __DIR__ .'/../views/buyTicketForm.php';
    }

    public function selectTicket(){
            if(isset($_POST['productId'])){

                $productId = $_POST['productId'];

                $result = $this->productService->getById($productId);
                $result->jsonSerialize();

                header('Content-Type: application/json;');
                echo json_encode($result);
            }

    }
    public function walkingTourDetailPage() {
        $eventService = new EventService();
        $events = $eventService->getAll();

        require __DIR__ . '/../views/walkingtour/walkingTourDetailPage.php';
    }
}

?>