<?php
require __DIR__ . '.controller.php';
require __DIR__ . '/../Services/eventService.php';
require __DIR__ . '/../Services/productService.php';
require __DIR__ . '/../Services/shoppingCartService.php';
require_once __DIR__ . '/../Models/shoppingCartModel.php';
require_once __DIR__ . '/../Models/productModel.php';

class buyTicketFormController extends Controller{
    public function index(){
        $eventService = new EventService();
        $events = $eventService->getAll();
        $thisEvent = $eventService->getByName("Walking Tour!");

        $shoppingCartService = new ShoppingCartService();
        $shoppingCart = $shoppingCartService->getCartOfUser(1);

        $productService = new ProductService();

        //get Tickets because products array is already taken
        $tickets = $productService->getByEventType($thisEvent->getId());

        require __DIR__ .'/../views/buyTicketForm.php';
    }
}