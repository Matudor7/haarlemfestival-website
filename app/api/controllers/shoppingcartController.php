<?php
require __DIR__ . '/../../Services/shoppingCartService.php';
require_once __DIR__ . '/../../Models/shoppingCartModel.php';

class ShoppingCartController{
    private $shoppingCartService;

    function __construct(){
        $this->shoppingCartService = new ShoppingCartService();
    }

    function index(){
        if($_SERVER["REQUEST_METHOD"] == "GET"){

            if(isset($_GET['user_id'])){
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($this->shoppingCartService->getCartOfUser($_GET['user_id']));
            }
        }
    }
}
?>