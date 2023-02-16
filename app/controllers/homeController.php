<?php
require __DIR__ . '/controller.php'; 

class HomeController extends Controller{
    public function index(){
        require __DIR__ . '/../views/homepage/index.php';
    }
}

?>