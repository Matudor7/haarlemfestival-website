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

    function return()
    {
        require_once __DIR__ . '/../vendor/autoload.php';
        require_once __DIR__ . '/../Services/paymentService.php';
        $shoppingCartService = new ShoppingCartService();

        //Ale
        require_once __DIR__ . '/../Services/paymentService.php';
        $paymentService = new PaymentService();
        // $itemsFromShoppingCart = $shoppingCartService->getCartOfUser($_SESSION['user_id']);
        //$paymentDetails = $paymentService->getByPaymentId();

        $paymentObject = $paymentService->getByUserId($_SESSION['user_id']);
        $shoppingCartService = new ShoppingCartService();

        $mollie = new Mollie\Api\MollieApiClient();
        $mollie->setApiKey('test_mgqJkkMVNtskk2e9vpgsBhUPsTj9K4');
        $orderService = new OrderService();
        $payment = $mollie->payments->get($paymentObject->getPaymentId());
        $order = $orderService->getOrderById($_GET['order_id'])[0];

        if ($payment->isPaid()) {
            //TODO move the logic to the controller


            $email = $paymentObject->getEmail();
            $fullName = $paymentObject->getFullName();
            $subtotal = "";

            $subject = "Your Haarlem Festival Order Invoice";

            // $message = nl2br("Hello, " . $paymentObject->getFirstName() . ".\n");
            //$message .= nl2br("Here your order invoice: \n");


            $message = "Here is your invoice, thanks for buying your ticket with us!!!";
            $pdfService = new PDFGenerator();
            if ($payment->isPaid()) {
                $html = "
        <head>
            <title>Invoice</title>
        </head>
        <body>
        <img src='/media/invoiceLogo.png' id='logo' class='img-fluid' alt='Logo'>
        <div id='festival-info'>
            <h3>Haarlem Festival</h3>
            <p>Grote Markt, Haarlem</p>
        </div>
        <br><br>
        
        <div>
            <table  style='width:100%; border-collapse:collapse; border: none;'>
                <tr>
                    <td style='color:#ff6600;border-top: 1px dashed #ff6600; border-left: none; border-right: none; border-bottom: none; font-weight: bold; text-transform:uppercase;'>BILL TO</td>
                    <td style='color:#ff6600;border-top: 1px dashed #ff6600; border-left: none; border-right: none; border-bottom: none; font-weight: bold;  text-transform:uppercase;'>CUSTOMER'S INF</td>
                    <td style='color:#ff6600; border: none; font-weight: bold; text-transform:uppercase;'>INVOICE#</td>
                    <td style= 'border-top: 1px dashed #ff6600; border-left: none; border-right: none; border-bottom: none;'>" . $order->invoice_number . "</td>
                </tr>
                <tr>
                 <td style='border: none;'>" . $paymentObject->first_name . '  ' . $paymentObject->last_name . " </td>
                    <td style='border: none;'>" . $paymentObject->email . "</td>
                    <td style='color: #ff6600; border: none; font-weight: bold; text-transform: uppercase;'>INVOICE DATE</td>
                    <td style='border: none;'>" . $order->invoice_date . "</td>
                </tr>
                <tr>
                    <td style='border: none;' >" . $paymentObject->address . "</td>
                    <td style='border: none;'>" . $paymentObject->phone_number . "</td>
                    <td style='color: #ff6600; border: none; font-weight: bold; text-transform: uppercase;'>PAYMENT DATE</td>
                    <td style='border: none;'>" . $order->invoice_date . "</td>
                </tr>
                <tr>
                    <td style='border: none;' >" . $paymentObject->zip . "</td>
                </tr>
            </table>
        </div><br><br>
        
        <table id='productTable'>
            <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th >Total</th>
            </tr>
            </thead>
            <tbody> ";
                $subtotal = 0;
                $shoppingCart = $shoppingCartService->getCartOfUser($_SESSION['user_id']);
                $productService = new ProductService();
                foreach ($shoppingCart->product_id as $item) {
                    $product = $productService->getById($item);
                    $subtotal += intval($shoppingCart->amount[0]) * $product->price;
                    $totalPricePerProduct = $product->calculateTotalPriceForProduct($shoppingCart->amount[0], $product->price);
                    $amount = $shoppingCart->amount[0];
                    $html .= "
            <tr>
                <td>" . $product->name . "</td>
                <td>" . $amount . "</td>
                <td>&#8364;" . $product->price . "</td>
                <td>" . $totalPricePerProduct . "</td>
            </tr> ";
                }
                $html .= "
            <tr>
                <td colspan='3'>Subtotal</td>
                <td>&#8364;" . $subtotal . "</td>
            </tr>
            <tr>
                <td colspan='3'>Tax</td>
                <td>&#8364;" . $subtotal * 0.21 . "</td>
            </tr>
            <tr>
                <td colspan='3' style='color:#ff6600;  font-weight: bold;'>TOTAL</td>
        
                <td style='color:#ff6600;  font-weight: bold;'> &#8364;" . $subtotal * 0.21 + $subtotal . "</td>
            </tr>
            </tbody>
        </table>
        <p><span style='font-family: 'Vladimir Script', cursive; font-size: 28px; text-align: right; display: block;'>Haarlem Festival</span></p>
        <div id='ThankYou'>
            <p style='border-top: 3px dashed #ff6600;'></p>
            <h1 style='color:#ff6600; text-align: center; font-weight: bold;'>Thank You</h1>
        
        </div>
        </body>
        </html>
        <style>
            #ThankYou{
                margin-top: 7em;
            }
            #productTable  {
                border-collapse: collapse;
                width: 100%;
            }
            #productTable th, td {
                border: 1px solid black;
                padding: 8px;
                text-align: left;
            }
            #productTable th {
                background-color: #ff6600;
                color: #fff;
            }
            #logo {
                margin-top: 1em;
                max-width: 210mm; /* set the maximum width to the width of an A4 paper */
                width: 100%;
                height: auto;
            }
            body {
                max-width: 210mm;
                margin: 0 auto;
            }
            #festival-info {
                text-align: center;
                font-size: 14px;
                color: #ff6600;
                text-transform: uppercase;
            }
        
            #festival-info h3 {
                margin-bottom: 5px;
                font-size: 20px;
            }
            #clients-inf table {
                border-collapse: collapse;
                border: none;
            }
        
            #festival-info p {
                margin: 0;
            }
        </style>";
                $invoicePdf = $pdfService->createPDF($_GET['order_id'], $_SESSION['user_id'], $html);
                $smtpService = new smtpService();
                $smtpService->sendEmail($email, $fullName, $message, $subject, $invoicePdf);

                //Andy
                $this->updateAvailability($shoppingCart);

                $shoppingCartService->removeCartFromUser($_SESSION['user_id']);

                $smtpService = new smtpService();

                $shoppingCartService->removeCartFromUser($_SESSION['user_id']);
                return;
                header("Location: http://localhost/");
            } else {
                echo "Payment Failed...";
            }

            require_once __DIR__ . '/navbarRequirements.php';
            //  header("Location: http://localhost/");
        }
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
        require_once __DIR__.'/../Services/shoppingCartService.php';
        $productService = new ProductService();
        $shoppingCartService = new ShoppingCartService();

        $products = $shoppingCart->getProducts();
        $amounts = $shoppingCart->getAmount();

        for ($i = 0; $i < count($products); $i++){
            $productService->updateProductAvailability($products[$i], $amounts[$i]);
            $product = $productService->getById($products[$i]);
            if($product->getEventType() == 2){
                $additionalInfo = $shoppingCartService->getAdditionalInfoByProduct($products[$i], $shoppingCart->getUserId());
                $reservationId = $this->getReservationId($additionalInfo);
                $this->changeReservationStatus($reservationId);
            }
        }
    }
    function getReservationId($additionalNote){
        $pattern = '/\(R#([a-zA-Z0-9]+)\)/';
        if (preg_match($pattern, $additionalNote, $matches)) {
            $reservationId = $matches[1];
        }
        return $reservationId;
    }

    function changeReservationStatus($reservationId){
        require_once __DIR__.'/../Services/ReservationService.php';
        $reservationService = new ReservationService();
        $reservationStatus = 0;
        $reservationService->changeReservationStatus($reservationId, $reservationStatus);
    }
}
?>