<?php
session_start();
require __DIR__ . '/controller.php';
require __DIR__ . '/../Services/paymentService.php';

class CheckoutController extends Controller{
    function index(){
        require __DIR__ . '/navbarRequirements.php';
        require __DIR__ . '/../views/checkout/index.php';
    }

    function payment(){
        if(isset($_GET["total"]) && isset($_GET["paymentmethod"])){
            $paymentService = new PaymentService();
            require __DIR__ . '/../views/checkout/payment.php';
        }
    }

    function return(){
        $paymentService = new PaymentService();

        $paymentObject = $paymentService->getByUserId($_SESSION['user_id']);
        require __DIR__ . '/../views/checkout/return.php';
    }

    function webhook(){
        require __DIR__ . '/../views/checkout/webhook.php';
    }
}
?>