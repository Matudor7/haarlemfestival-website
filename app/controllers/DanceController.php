<?php
require __DIR__ . '/controller.php'; 

class DanceController extends Controller{
    public function index(){
        require __DIR__ . '/../views/homepage/DanceView.php';
    }
}

?>