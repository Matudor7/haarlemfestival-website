<?php
require __DIR__ . '/controller.php'; 

class YummyController extends Controller{
    public function index(){
        require __DIR__ . '/../views/yummy/index.php';
    }
}

?>