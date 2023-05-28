<?php
session_start();
require_once  __DIR__ . '/../../Services/paymentService.php';
require_once __DIR__ . '/../../Models/paymentModel.php';

class PaymentController{
    private $paymentService;

    function __construct(){
        $this->paymentService = new PaymentService();
    }

    function index(){
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            if(isset($_GET['api_key']) && isset($_SESSION['external_api_key'])){
                if($_GET['api_key'] == $_SESSION['external_api_key']){
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($this->paymentService->getAll());
                }
            }
        }
    }
}
?>