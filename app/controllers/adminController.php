<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/festivalService.php';

class AdminController extends Controller{
    public function index(){
        $festivalService = new FestivalService();
        $festival = $festivalService->getFestival();
        require __DIR__ . '/../views/admin/index.php';
    }
}

?>