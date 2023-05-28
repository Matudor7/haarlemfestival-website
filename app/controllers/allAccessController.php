<?php
session_start();
require __DIR__ . '/controller.php';

class allAccessController extends Controller{
    public function index(){
        //$events = $this->eventService->getAll();
        require __DIR__ . '/navbarRequirements.php';
        require_once __DIR__ . '/../Services/eventService.php';
        $eventService = new EventService();
        $thisEvent = $eventService->getByName("All-Access!");

        require_once __DIR__ . '/../Services/productService.php';
        $productService = new ProductService();
        $tickets = $productService->getByEventType($thisEvent->getId());

        require_once __DIR__ . '/../Services/AllAccessService.php';
        $allAccessService = new AllAccessService();
        $allPasses = $allAccessService->getAllPasses();

        require_once __DIR__ . '/../views/allaccess/index.php';
        require_once __DIR__ .'/../views/buyTicketForm.php';

    }

    public function getAllAccessContent(string $elementId){
        require_once __DIR__ . '/../Services/AllAccessService.php';
        $allAccessService = new AllAccessService();

        return $allAccessService->getAllAccessContent($elementId);
    }
}