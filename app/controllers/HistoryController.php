<?php
require __DIR__ . '/controller.php'; 

class HistoryController extends Controller{
    public function index(){
        require __DIR__ . '/../views/homepage/HistoryView.php';
    }
}

?>