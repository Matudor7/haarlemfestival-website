<?php
//Tudor Nosca (678549)
session_start();
require __DIR__ . '/controller.php';
class HomeController extends Controller{
    public function index(){
        if(!isset($_SESSION['user_id'])){
            $_SESSION['user_id'] = rand(999999, 2000000);
        }

        require __DIR__ . '/navbarRequirements.php';
        require __DIR__ . '/../views/homepage/index.php';
    }
}
?>