<?php
session_start();
require __DIR__ . '/controller.php';
class HomeController extends Controller{
    public function index(){
        //TODO: change the user id to 0 after done testing.
        $_SESSION['user_id'] = 1;
        require __DIR__ . '/navbarRequirements.php';
        require __DIR__ . '/../views/homepage/index.php';
    }
}
?>