<?php
//Tudor Nosca (678549)
session_start();
require __DIR__ . '/controller.php';
//require_once __DIR__ . '/../Services/paymentService.php';
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
            $this->paymentProcess();
        }
    }

    private function paymentProcess(){
        $paymentService = new PaymentService();
        require_once __DIR__ . '/../../vendor/autoload.php';

        $mollie = new Mollie\Api\MollieApiClient();
        $mollie->setApiKey('test_mgqJkkMVNtskk2e9vpgsBhUPsTj9K4');

        $paymentMethod;

        if($_GET["paymentmethod"] == 'ideal'){
            $paymentMethod = \Mollie\Api\Types\PaymentMethod::IDEAL;
        } else{
            $paymentMethod = \Mollie\Api\Types\PaymentMethod::CREDITCARD;
        }

        $payment = $mollie->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => $_GET["total"] . ".00"
            ],
            "description" => "Haarlem Festival Payment",
            "method" => $paymentMethod,
            "webhookUrl"  => "https://f656-145-81-195-167.ngrok-free.app/checkout/webhook",
            "redirectUrl" => "https://f656-145-81-195-167.ngrok-free.app/checkout/return",
        ]);

        $paymentService->addPaymentId($_SESSION['user_id'], $payment->id);

        header("Location: " . $payment->getCheckoutUrl());
    }


    function return(){
        $shoppingCartService = new ShoppingCartService();

        //Ale
        $paymentService = new PaymentService();
        $itemsFromShoppingCart = $shoppingCartService->getCartOfUser($_SESSION['user_id']);
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