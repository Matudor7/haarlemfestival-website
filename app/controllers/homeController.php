<?php
//Tudor Nosca (678549)
session_start();
require __DIR__ . '/controller.php';
require __DIR__ . '/../Services/ContentService.php';
class HomeController extends Controller{
    public function index(){
        if(!isset($_SESSION['user_id'])){
           $_SESSION['user_id'] = rand(999999, 2000000);
        }

        //echo $_SESSION['user_id'];

        $contentService = new ContentService;
        $contents= $contentService->getAllContent();

        require __DIR__ . '/navbarRequirements.php';
        require __DIR__ . '/../views/checkout/testingPDFTicket.php';
        //require __DIR__ . '/../views/checkout/testingPDFDesign.php';
        require __DIR__ . '/../views/homepage/index.php';
    }
    public function test()
    {
        //$eventService = new EventService();
        //$events = $eventService->getAll();
        require __DIR__ . '/navbarRequirements.php';
        require __DIR__ . '/../views/checkout/testingPDFDesign.php';
    }
}
?>