<?php
session_start();
require __DIR__ . '/controller.php';

class CheckoutController extends Controller{
    function index(){
        require __DIR__ . '/navbarRequirements.php';
        require __DIR__ . '/../views/checkout/index.php';
    }

    function payment(){
        if(isset($_GET["total"]) && isset($_GET["paymentmethod"])){
            require __DIR__ . '/../views/checkout/payment.php';
        }
    }

    function return(){
        require __DIR__ . '/../views/checkout/return.php';
    }

    function webhook(){
        require __DIR__ . '/../views/checkout/webhook.php';
    }
}
?>