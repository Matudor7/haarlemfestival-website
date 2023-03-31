<?php
require __DIR__ . '/controller.php'; 
require __DIR__ . '/../Services/eventService.php';
require __DIR__ . '/../Services/walkingTourService.php';
require_once __DIR__ . '/../Models/WalkingTourModel.php';
require __DIR__ . '/../Services/productService.php';
require __DIR__ . '/../Services/shoppingCartService.php';

class WalkingTourController extends Controller{
    
    public function index(){

        $eventService = new EventService();
        $events = $eventService->getAll();
        $thisEvent = $eventService->getByName("Walking Tour!");

        $walkingTourService = new WalkingTourService();
        $walkingTours = $walkingTourService->getAllWalkingTours();
        $prices = $walkingTourService->getTourPrices();
        $locations = $walkingTourService->getTourLocations();
        $timetables = $walkingTourService->getTourTimetable();
        $languages = $walkingTourService->getTourLanguages();

        $shoppingCartService = new ShoppingCartService();
        $shoppingCart = $shoppingCartService->getCartOfUser(1);

        $productService = new ProductService();

        //get Tickets because products array is already taken
        $tickets = $productService->getByEventType($thisEvent->getId());

        //This causes every object to be its own array
        $products = [];
        foreach($shoppingCart->getProducts() as $product_id){
            array_push($products, $productService->getById($product_id));
        }

        //This merges all products to be in a single-level array
        $merged_products = array_merge(...$products);

        //"Amounts" will always be equal to the number of products in the array 
        $amounts = [];
        foreach($shoppingCart->getAmount() as $amount){
            array_push($amounts, $amount);
        }

        require __DIR__ . '/../views/walkingtour/index.php';
        require __DIR__ .'/../views/buyTicketForm.php';
    }

    public function walkingTourDetailPage() {
        $eventService = new EventService();
        $events = $eventService->getAll();

        require __DIR__ . '/../views/walkingtour/walkingTourDetailPage.php';
    }
}

?>