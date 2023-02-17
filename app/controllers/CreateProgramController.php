<?php
require __DIR__ . '/controller.php'; 

class CreateProgramController extends Controller{
    public function index(){
        require __DIR__ . '/../views/program/index.php';
    }
}

?>