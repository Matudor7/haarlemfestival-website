<?php
require __DIR__ . '/../../Services/shoppingCartService.php';
require_once __DIR__ . '/../../Models/shoppingCartModel.php';
class shoppingController
{
    private $shoppingCartService;

    function __construct(){

        $this->shoppingCartService = new ShoppingCartService();

    }
    function index(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){

        $shoppingCartItemsJsonString = file_get_contents('php://input');
        $paymentData = json_decode($shoppingCartItemsJsonString, true);
        //$shoppingCart =  new shoppingCart();
        $userId =  $_SESSION["user_id"];
        $product_id = $paymentData["product_id"];
        $amount = $paymentData["amount"];
        $event_type = $paymentData["event_type"];
        $additional_info = $paymentData["additional_info"];

        $this->shoppingCartService->addProducts($userId, $product_id, $amount, $event_type, $additional_info);
    }
}
}