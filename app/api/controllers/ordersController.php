<?php
session_start();
require __DIR__ . '/../../Services/OrderService.php';
require_once __DIR__ . '/../../Models/Order.php';

class OrdersController{
    private $orderService;

    function __construct(){
        $this->orderService = new OrderService();
    }

    function index(){
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            if(isset($_GET['api_key']) && isset($_SESSION['external_api_key'])){
                if($_GET['api_key'] == $_SESSION['external_api_key']){
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($this->orderService->getAll());
                }
            }
        }

        if($_SERVER["REQUEST_METHOD"] == "PATCH"){
            if(isset($_GET['id'])){

                $orderJsonString = file_get_contents('php://input');

                $orderData = json_decode($orderJsonString, true);
    
                if(!is_null($this->orderService->getOrderByID($_GET['id']))){
                    $id = $_GET['id'];
                    $this->orderService->changePaymentStatus($id, $orderData['payment_status']);
                }
            }
        }
    }
}
?>