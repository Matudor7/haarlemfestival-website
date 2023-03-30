<?php
require __DIR__ . '/controller.php';
class HomeController extends Controller{
    public function index(){
        $_SESSION['user_id'] = 0;
        require __DIR__ . '/navbarRequirements.php';
        require __DIR__ . '/../views/homepage/index.php';
    }
}
?>