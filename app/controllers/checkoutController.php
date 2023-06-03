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

require_once __DIR__ . '/../Services/pdfGenerator.php';
require_once __DIR__ . '/../Models/productModel.php';
require_once __DIR__ . '/../Services/productService.php';
require_once __DIR__ . '/../Services/TicketService.php';



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
            $ticketService = new TicketService();
            foreach ($shoppingCart->product_id as $item) {

                $product = $productService->getById($item);
                $ticket = new Ticket();

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
                $ticket->setPrice($product->getPrice());
                //$ticket->setQuantity($item->amount);
                // $ticket->setUserId($item->user_id);
                array_push($tickets, $ticketService->storeTicketDB($ticket));

            }
            $order->setInvoiceDate();
            $order->setInvoiceNumber();
            $order->setPaymentId(1);
            $order->setPaymentStatus("Paid");
            $orderService = new OrderService();
            $newOrder = $orderService->insertOrder($order);
            $this->paymentProcess($newOrder, $tickets);

            return $tickets;

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
       // $itemsFromShoppingCart = $shoppingCartService->getCartOfUser($_SESSION['user_id']);
        //$paymentDetails = $paymentService->getByPaymentId();

        $paymentObject = $paymentService->getByUserId($_SESSION['user_id']);
        $shoppingCartService = new ShoppingCartService();

        $mollie = new Mollie\Api\MollieApiClient();
        $mollie->setApiKey('test_mgqJkkMVNtskk2e9vpgsBhUPsTj9K4');
        $orderService =  new OrderService();
        $payment = $mollie->payments->get($paymentObject->getPaymentId());
        $order = $orderService->getOrderById($_GET['order_id'])[0];

        if ($payment->isPaid()) {
            //TODO move the logic to the controller
        

            $email = $paymentObject->getEmail();
            $fullName = $paymentObject->getFullName();
            $subtotal = "";
        
            $subject = "Your Haarlem Festival Order Invoice and Tickets";
        
           // $message = nl2br("Hello, " . $paymentObject->getFirstName() . ".\n");
            //$message .= nl2br("Here your order invoice: \n");


                $message = "Here is your invoice and your tickets, thanks for buying your ticket with us!!!";
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
                    <td style= 'border-top: 1px dashed #ff6600; border-left: none; border-right: none; border-bottom: none;'>". $order->invoice_number."</td>
                </tr>
                <tr>
                 <td style='border: none;'>". $paymentObject->first_name . '  '. $paymentObject->last_name." </td>
                    <td style='border: none;'>".$paymentObject->email."</td>
                    <td style='color: #ff6600; border: none; font-weight: bold; text-transform: uppercase;'>INVOICE DATE</td>
                    <td style='border: none;'>".$order->invoice_date."</td>
                </tr>
                <tr>
                    <td style='border: none;' >".$paymentObject->address."</td>
                    <td style='border: none;'>".$paymentObject->phone_number."</td>
                    <td style='color: #ff6600; border: none; font-weight: bold; text-transform: uppercase;'>PAYMENT DATE</td>
                    <td style='border: none;'>".$order->invoice_date."</td>
                </tr>
                <tr>
                    <td style='border: none;' >".$paymentObject->zip."</td>
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
                <td>".$product->name."</td>
                <td>".$amount."</td>
                <td>&#8364;".$product->price."</td>
                <td>".$totalPricePerProduct."</td>
            </tr> ";
            }
         $html .= "
            <tr>
                <td colspan='3'>Subtotal</td>
                <td>&#8364;".$subtotal."</td>
            </tr>
            <tr>
                <td colspan='3'>Tax</td>
                <td>&#8364;".$subtotal * 0.21."</td>
            </tr>
            <tr>
                <td colspan='3' style='color:#ff6600;  font-weight: bold;'>TOTAL</td>
        
                <td style='color:#ff6600;  font-weight: bold;'> &#8364;".$subtotal * 0.21 + $subtotal."</td>
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
                $ticketPDF = $this->generateTicketPdf($this->payment());
            $smtpService = new smtpService();
            $smtpService->sendEmail($email, $fullName, $message, $subject, $invoicePdf, $ticketPDF);
            
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

         function generateTicketPdf($tickets)
        {
            $qrService = new QrService();
            //get the list of ticket and for each ticket generate a qr code and diplay the rest of the pdf as well with info related to that tickets
            // $qrService->generateQrCode($ticket);
            $pdf = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>Haarlem Festival Ticket</title>
    </head>
    <body>
    <div class='container'>
        <div class='header'>
            <h1>Haarlem Festival Ticket</h1> ";
            foreach ($tickets as $ticket) {
                $qr_code_ur = $qrService->generateQrCode($ticket);
                $client_name = $ticket->client_name;
                $event_name = $ticket->event_name;
                $event_date = $ticket->event_date;
                $event_time = $ticket->event_time;
                $event_type = $ticket->event_type;
                $pdf .= "
            <h2>" . $event_type . "</h2>
            <div class='qr-code'>
                <img src='" . $qr_code_ur . "' alt='QR code'>
            </div>
            <div class='info'>
                <p><span class='label'>Name:</span>" . $client_name . "</p>
                <p><span class='label'>Event:</span>" . $event_name . "</p>
                <p><span class='label'>Date:</span>" . $event_date . "</p>
                <p><span class='label'>Time:</span> " . $event_time . "</p>
            </div>
    </body>
    </html>
<style>
    body {
        <!--background-image: url('path/to/background/image.jpg');-->
        background-size: cover;
        background-position: center;
        font-family: Arial, sans-serif;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 100%;
        max-width: 397px; /* Half of A4 width in pixels */
        margin: 0 auto;
        padding: 20px;
        box-sizing: border-box;
        background-color: #fff;
        opacity: 0.9;
        border: 10px solid #FF6600FF; /* default border color */
    }

    .container.purple {
        border-color: #8564CC; /* blue border color for blue event type */
    }

    .container.blue {
        border-color: #0d47a1;
        /*border-color: #3366CFFF;*/ /* green border color for green event type */
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
    }

    h1 {
        font-size: 36px;
        margin: 0;
        padding: 0;
    }

    h2 {
        font-size: 24px;
        margin: 0;
        padding: 0;
    }

    .qr-code {
        float: right;
        margin-left: 30px;
        width: 75px;
        height: 75px;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #333;
        border-radius: 3px;
        text-align: center;
    }

    .qr-code img {
        max-width: 100%;
        height: auto;
    }

    .info {
        margin-top: 25px;
        font-size: 14px;
    }

    .label {
        font-weight: bold;
        display: inline-block;
        min-width: 70px;
    }
</style>";


            }
            return $pdf;

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