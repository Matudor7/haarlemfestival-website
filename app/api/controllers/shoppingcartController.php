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

        if($_SERVER["REQUEST_METHOD"] == "PATCH"){
            if(isset($_GET['user_id']) && isset($_GET['product_id']) && isset($_GET['action'])){
                if($_GET['action'] == "add"){
                    $this->shoppingCartService->addAmount($_GET['user_id'], $_GET['product_id']);
                }else if($_GET['action'] == "delete"){
                    $this->shoppingCartService->removeAmount($_GET['user_id'], $_GET['product_id']);
                }
            }
        }
    }
}
?>