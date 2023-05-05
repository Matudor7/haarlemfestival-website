<?php
//Tudor Nosca (678549)
session_start();
require __DIR__ . '/controller.php';
require_once __DIR__ . '/../Services/shoppingCartService.php';
require_once __DIR__ . '/../Services/smtpService.php';
require_once __DIR__ . '/../Services/OrderService.php';
require_once __DIR__ . '/../Models/Order.php';


class CheckoutController extends Controller{
    function index(){
        require_once __DIR__ . '/navbarRequirements.php';
        require_once __DIR__ . '/../views/checkout/index.php';
    }

    
    function payment(){
        require_once __DIR__ . '/../Services/paymentService.php';
        if(isset($_GET["total"]) && isset($_GET["paymentmethod"])){
            //Ale
            $order = new order();
            $shoppingCartService = new ShoppingCartService();
            $shoppingCart = $shoppingCartService->getCartOfUser($_SESSION['user_id']);
            $tickets = array();

            foreach ($shoppingCart as $item) {
                $ticket = new ticket();
                switch ($item->getEventType()) {
                    case 1:
                        $ticket->setDanceEventId($item->getEventType());
                        break;
                    case 2:
                        $ticket->setYummyEventId($item->getEventType());
                        break;
                    case 44:
                        $ticket->setHistoryEventId($item->getEventType());
                        break;
                    case 45:
                        $ticket->setAccessPassId($item->getEventType());
                        break;
                }
                $ticket->setQuantity($item->amount);
                $ticket->setUserId($item->user_id);
                array_push($tickets, $ticket);
            }
            $order->setInvoiceDate();
            $order->setInvoiceNumber();
            //$order->setListProductId("1,2,3");
            //$order->setOrderId(1);
            $order->setPaymentId(1);
            $order->setPaymentStatus("Paid");
            $orderService = new OrderService();
            $newOrder = $orderService->insertOrder($order);
            $this->paymentProcess($newOrder, $tickets);
        }
    }

    private function paymentProcess($order, $ticket){
        $paymentService = new PaymentService();
        require_once __DIR__ . '/../vendor/autoload.php';

        $mollie = new Mollie\Api\MollieApiClient();
        $mollie->setApiKey('test_mgqJkkMVNtskk2e9vpgsBhUPsTj9K4');

        $paymentMethod;

        if($_GET["paymentmethod"] == 'ideal'){
            $paymentMethod = \Mollie\Api\Types\PaymentMethod::IDEAL;
        } else{
            $paymentMethod = \Mollie\Api\Types\PaymentMethod::CREDITCARD;
        }

        $orderId = $order[0]->getOrderId();
        $payment = $mollie->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => $_GET["total"] . ".00"
            ],
            "description" => "Haarlem Festival Payment",
            "method" => $paymentMethod,
            "webhookUrl"  => "https://a5f9-31-151-76-20.ngrok-free.app/checkout/webhook",
           // "redirectUrl" => "localhost/checkout/return",
            "redirectUrl" => "http://localhost/checkout/return?order_id={$orderId}" ,
            "metadata" => [
                "order_id" => $orderId,
                "ticket" => $ticket,
                "userId" => $_SESSION['user_id'],
            ],
        ]);

        $paymentService->addPaymentId($_SESSION['user_id'], $payment->id);

        header("Location: " . $payment->getCheckoutUrl());
    }

    function return(){
        require_once __DIR__ . '/../Services/paymentService.php';
        $shoppingCartService = new ShoppingCartService();

        //Ale
        $paymentService = new PaymentService();
        $itemsFromShoppingCart = $shoppingCartService->getCartOfUser($_SESSION['user_id']);
        //$paymentDetails = $paymentService->getByPaymentId();

        $smtpService = new smtpService();
        $this->getMolliePayment();
        
        require_once __DIR__ . '/navbarRequirements.php';
        require __DIR__ . '/../views/checkout/return.php';
    }

    private function getMolliePayment(){
        require_once __DIR__ . '/../vendor/autoload.php';
        $mollie = new Mollie\Api\MollieApiClient();
        $mollie->setApiKey('test_mgqJkkMVNtskk2e9vpgsBhUPsTj9K4');

        $payment = $mollie->payments->get($paymentObject->getPaymentId());
    }

    function webhook(){
        require __DIR__ . '/../views/checkout/webhook.php';
    }
}
?>