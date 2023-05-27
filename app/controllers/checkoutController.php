<?php
//Tudor Nosca (678549)
session_start();
require __DIR__ . '/controller.php';

require_once __DIR__ . '/../Services/paymentService.php';
require_once __DIR__ . '/../Services/shoppingCartService.php';
require_once __DIR__ . '/../Services/smtpService.php';
require_once __DIR__ . '/../Services/OrderService.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Models/Order.php';
require_once __DIR__ . '/../Models/ticket.php';
require_once __DIR__ . '/../Services/pdfGenerator.php';
require_once __DIR__ . '/../Models/productModel.php';
require_once __DIR__ . '/../Services/productService.php';



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
            $productService = new ProductService();
            foreach ($shoppingCart->product_id as $item) {

                $product = $productService->getById($item);
               $ticket = new ticket();
                switch ($product->getEventType()) {
                //switch ($item->eventType) {
                    case 1:
                        $ticket->setDanceEventId($product->getEventType());
                        break;
                    case 2:
                        $ticket->setYummyEventId($product->getEventType());
                        break;
                    case 44:
                        $ticket->setHistoryEventId($product->getEventType());
                        break;
                    case 45:
                        $ticket->setAccessPassId($product->getEventType());
                        break;
                    default:
                        throw  new Exception("Invalid event type");
                        break;
                }
                $ticket->quantity = 1;
                $ticket->user_id = $_SESSION['user_id'];
                //$ticket->setQuantity($item->amount);
               // $ticket->setUserId($item->user_id);
                array_push($tickets, $ticket);
            }
            $order->setInvoiceDate();
            $order->setInvoiceNumber();
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
        require_once __DIR__ . '/../Models/Order.php';
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

            "webhookUrl"  => "https://df38-2a02-a210-29c1-6180-bc3d-f4e6-cb5a-f157.ngrok-free.app/checkout/webhook",
           // "redirectUrl" => "localhost/checkout/return",
            "redirectUrl" => "http://localhost/checkout/return?order_id={$orderId}" ,
            "metadata" => [
                "order_id" => $orderId,
                "ticket" => $ticket,
               // "payment_id" => "1", //TODO: change to payment id
                "userId" => $_SESSION['user_id'],
            ],
        ]);

        $paymentService->addPaymentId($_SESSION['user_id'], $payment->id);

        $paymentObject = $paymentService->getByUserId($_SESSION['user_id']);
        //$payment = $mollie->payments->get($paymentObject->getPaymentId());
        header("Location: ". $payment->getCheckoutUrl());

    }

    function return(){
        require_once __DIR__ . '/../vendor/autoload.php';
        require_once __DIR__ . '/../Services/paymentService.php';
        $shoppingCartService = new ShoppingCartService();

        //Ale
        require_once __DIR__ . '/../Services/paymentService.php';
        $paymentService = new PaymentService();

        $paymentObject = $paymentService->getByUserId($_SESSION['user_id']);
        $shoppingCartService = new ShoppingCartService();

        $mollie = new Mollie\Api\MollieApiClient();
        $mollie->setApiKey('test_mgqJkkMVNtskk2e9vpgsBhUPsTj9K4');
        $orderService =  new OrderService();
        $payment = $mollie->payments->get($paymentObject->getPaymentId());
        $order = $orderService->getOrderById($_GET['order_id'])[0];

        $subject = "Your Haarlem Festival Order Invoice";

        $message = "Here is your invoice, thanks for buying your ticket with us!!!";
        if ($payment->isPaid()) {
            //TODO move the logic to the controller


            $pdfService = new PDFGenerator();
            if ($payment->isPaid()) {

            $invoicePDF = $pdfService->generateInvoicePDF($paymentObject, $order);
                $invoicePdf = $pdfService->createPDF($_GET['order_id'], $_SESSION['user_id'], $invoicePDF);
            $smtpService = new smtpService();
            $fullName = $paymentObject->first_name . " " . $paymentObject->last_name;
            $smtpService->sendEmail($paymentObject->email, $fullName, $message, $subject, $invoicePdf);
            
            //Andy
            //$this->updateAvailability($itemsFromShoppingCart);

            $shoppingCartService->removeCartFromUser($_SESSION['user_id']);

            $smtpService = new smtpService();

            $shoppingCartService->removeCartFromUser($_SESSION['user_id']);
            return;
            header("Location: http://localhost/");
        } else {
            echo "Payment Failed...";
        }
        
        require_once __DIR__ . '/navbarRequirements.php';
       header("Location: http://localhost/");
    }

    // private function getMolliePayment(){
    //     require_once __DIR__ . '/../vendor/autoload.php';
    //     $mollie = new Mollie\Api\MollieApiClient();
    //     $paymentService = new PaymentService();
    //     $mollie->setApiKey('test_mgqJkkMVNtskk2e9vpgsBhUPsTj9K4');
    //     $paymentObject = $paymentService->getByUserId($_SESSION['user_id']);
    //     echo $_SESSION['user_id'];
    //     $payment = $mollie->payments->get($paymentObject->getPaymentId());
    // }

    function webhook(){
        require __DIR__ . '/../views/checkout/webhook.php';
    }

    function updateAvailability($shoppingCart){
        require_once __DIR__ . '/../Services/productService.php';
        $productService = new ProductService();

        $products = $shoppingCart->getProducts();
        $amounts = $shoppingCart->getAmount();

        for ($i = 0; $i < count($products); $i++){
            $productService->updateProductAvailability($products[$i], $amounts[$i]);
        }
    }
}}
?>