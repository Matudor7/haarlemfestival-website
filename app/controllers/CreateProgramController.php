<?php
require __DIR__ . '/controller.php'; 

class CreateProgramController extends Controller{
    public function index(){
        require __DIR__ . '/../views/homepage/CreateProgramView.php';
    }
}

?>