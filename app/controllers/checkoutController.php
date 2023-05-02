<?php
//Tudor Nosca (678549)
session_start();
require __DIR__ . '/controller.php';
//include __DIR__ . '/../Services/paymentService.php';
require_once __DIR__ . '/../Services/shoppingCartService.php';
require_once __DIR__ . '/../Services/smtpService.php';


class CheckoutController extends Controller{
    function index(){
        require_once __DIR__ . '/navbarRequirements.php';
        require_once __DIR__ . '/../views/checkout/index.php';
    }

    function payment(){
        require_once __DIR__ . '/../Services/paymentService.php';
        if(isset($_GET["total"]) && isset($_GET["paymentmethod"])){
            $paymentService = new PaymentService();
            require_once __DIR__ . '/../views/checkout/payment.php';
        }
    }


    function return(){
        $shoppingCartService = new ShoppingCartService();

        //Ale
        require_once __DIR__ . '/../Services/paymentService.php';
        $paymentService = new PaymentService();
       // $itemsFromShoppingCart = $shoppingCartService->getCartOfUser($_SESSION['user_id']);
        //$paymentDetails = $paymentService->getByPaymentId();

        $smtpService = new smtpService();
        require_once __DIR__ . '/navbarRequirements.php';
        require __DIR__ . '/../views/checkout/return.php';
    }

    function webhook(){
        require __DIR__ . '/../views/checkout/webhook.php';
    }
}
?>