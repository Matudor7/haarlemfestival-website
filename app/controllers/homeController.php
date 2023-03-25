<?php
echo session_save_path();
require __DIR__ . '/controller.php';
require __DIR__ . '/../Services/eventService.php';
require __DIR__ . '/../Services/productService.php';

class HomeController extends Controller{
    public function index(){
        $eventService = new EventService();
        $events = $eventService->getAll();

        $productService = new ProductService();
        $products = $productService->getAll();

        $_SESSION['user'] = 1;
        
        require __DIR__ . '/../views/homepage/index.php';
    }
}
?>