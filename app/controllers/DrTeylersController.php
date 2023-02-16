<?php
require __DIR__ . '/controller.php'; 

class DrTeylersController extends Controller{
    public function index(){
        require __DIR__ . '/../views/homepage/DrTeylersView.php';
    }
}

?>