<?php
//Tudor Nosca (678549)
session_start();
require __DIR__ . '/controller.php';
class ScanTicketController extends Controller{
    public function index(){
        require __DIR__ .'/../views/scanTicket.php';
    }
}