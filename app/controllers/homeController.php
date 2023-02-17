<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../Services/eventService.php';

class HomeController extends Controller{
    public function index(){
        require __DIR__ . '/../views/homepage/index.php';
    }
}

?>