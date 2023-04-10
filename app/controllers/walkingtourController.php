<?php
session_start();
require __DIR__ . '/controller.php';
require __DIR__ . '/../Services/walkingTourService.php';
require_once __DIR__ . '/../Models/WalkingTourModel.php';



class WalkingTourController extends Controller{

    //private $eventService;
    private $walkingTourService;
    //private $productService;

    private $shoppingCartService;

    function __construct(){
        //$this->eventService = new EventService();
        $this->walkingTourService = new WalkingTourService();
        //$this->productService = new ProductService();
}
    public function index(){
        //$events = $this->eventService->getAll();
        require __DIR__ . '/navbarRequirements.php';
        require_once __DIR__ . '/../Services/eventService.php';
        $eventService = new EventService();
        $thisEvent = $eventService->getByName("WalkingTour");

        require_once __DIR__ . '/../Services/productService.php';
        $productService = new ProductService();
        $tickets = $productService->getByEventType($thisEvent->getId());



        $walkingTours = $this->walkingTourService->getAllWalkingTours();
        $prices = $this->walkingTourService->getTourPrices();
        $locations = $this->walkingTourService->getTourLocations();
        $timetables = $this->walkingTourService->getTourTimetable();
        $languages = $this->walkingTourService->getTourLanguages();



        require __DIR__ . '/../views/walkingtour/index.php';
        require __DIR__ .'/../views/buyTicketForm.php';

    }

    public function selectTicket(){

        require_once __DIR__ . '/../Services/productService.php';
        $productService = new ProductService();

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $data = json_decode(file_get_contents("php://input"), true);

            if(isset($data['productId'])){
                $productId = $data['productId'];

                $result = $productService->getById($productId);

                header('Content-Type: application/json;');
                echo json_encode($result);
            }  else {echo json_encode("does not work yet");}
        }
    }

    public function addToCart(){

        require __DIR__ . '/../Services/shoppingCartService.php';

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $data = json_decode(file_get_contents("php://input"), true);

            if(isset($data['productId'])&isset($data['userId'])){
                $productId = $data['productId'];
                $userId = $data['userId'];
                $amount = $data['amount'];

                $shoppingCartService = new ShoppingCartService();
                $result = $shoppingCartService->addProducts($userId, $productId, $amount);

                header('Content-Type: application/json;');
                echo json_encode($result);
            }  else {echo json_encode("Something went wrong");}
        }
    }
    public function walkingTourDetailPage() {
        //$eventService = new EventService();
        //$events = $eventService->getAll();

        require __DIR__ . '/navbarRequirements.php';
        require __DIR__ . '/../views/walkingtour/walkingTourDetailPage.php';
    }
}

?>