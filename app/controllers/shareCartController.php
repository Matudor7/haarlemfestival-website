<?php
//Tudor Nosca (678549)
session_start();
require __DIR__ . '/controller.php';
class ShareCartController extends Controller{
    public function index(){
        require __DIR__ . '/navbarRequirements.php';
        require __DIR__ . '/../views/sharedCart.php';
    }
}