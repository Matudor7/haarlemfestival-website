<?php
session_start();
require __DIR__ . '/controller.php';

class allaccessController extends Controller{
    public function index(){
        //$events = $this->eventService->getAll();
        require __DIR__ . '/navbarRequirements.php';
        require_once __DIR__ . '/../Services/eventService.php';
        $eventService = new EventService();
        $thisEvent = $eventService->getByName("AllAccess!");

        require_once __DIR__ . '/../Services/productService.php';
        $productService = new ProductService();
        $tickets = $productService->getByEventType($thisEvent->getId());


        require __DIR__ . '/../views/allaccess/index.php';
        require __DIR__ .'/../views/buyTicketForm.php';

    }
}