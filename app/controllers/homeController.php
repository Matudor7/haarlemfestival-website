<?php
session_start();
require __DIR__ . '/controller.php';
class HomeController extends Controller{
    public function index(){
        //TODO: change the user id to 0 after done testing.
        if(!isset($_SESSION['user_id'])){
            $_SESSION['user_id'] = 0;
        }
        require __DIR__ . '/navbarRequirements.php';
        require __DIR__ . '/../views/homepage/index.php';
    }
}
?>