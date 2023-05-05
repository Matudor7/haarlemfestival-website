<?php
require_once __DIR__ . '/../../Services/paymentService.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__. '/../../Models/Order.php';
require_once __DIR__ . '/../../Services/pdfGenerator.php';
require_once __DIR__ . '/../../Services/smtpService.php';
require_once __DIR__ . '/../../Services/shoppingCartService.php';


$paymentService = new PaymentService();
$paymentObject = $paymentService->getByUserId(0);
$orderService = new OrderService();
$shoppingCartService = new ShoppingCartService();
$smtpService = new smtpService();
$order  = new order();
$mollie = new Mollie\Api\MollieApiClient();
$mollie->setApiKey('test_mgqJkkMVNtskk2e9vpgsBhUPsTj9K4');

$payment = $mollie->payments->get($paymentObject->getPaymentId());
$order = $orderService->getOrderByID($_GET['order_id']);


if ($payment->isPaid()) {
    //TODO move the logic to the controller



    $shoppingCart = $shoppingCartService->getCartOfUser(0);


    $email = $paymentObject->getEmail();
    $fullName = $paymentObject->getFullName();
    $subtotal = "";

    $subject = "Your Haarlem Festival Order Invoice";

   // $message = nl2br("Hello, " . $paymentObject->getFirstName() . ".\n");
    //$message .= nl2br("Here your order invoice: \n");

        $message = "Here is your invoice, thanks for buying your ticket with us!!!";
        $pdfService = new PDFGenerator();
        $html = "<html>
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
            <td style= 'border-top: 1px dashed #ff6600; border-left: none; border-right: none; border-bottom: none;'>".$order[0]->getInvoiceNumber() ."</td>
        </tr>
        <tr>
            <td style='border: none;'><?=$payment->getFullName();?></td>
            <td style='border: none;'><?=$payment->getEmail();?></td>
            <td style='color: #ff6600; border: none; font-weight: bold; text-transform: uppercase;'>INVOICE DATE</td>
            <td style='border: none;'>".$order[0]->getInvoiceDate() ."</td>
        </tr>
        <tr>
            <td style='border: none;' ><?=$payment->getAddress();?></td>
            <td style='border: none;'><?=$payment->getPhoneNumber();?></td>
            <td style='color: #ff6600; border: none; font-weight: bold; text-transform: uppercase;'>PAYMENT DATE</td>
            <td style='border: none;'>".$order[0]->getInvoiceDate() ."</td>
        </tr>
        <tr>
            <td style='border: none;' ><?=$payment->getZip();?></td>
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
    <tbody>
   <?php 
    foreach ($shoppingCart[0]->getProducts() as $product) {
        $subtotal += $product->calculateTotalPrice($shoppingCart[0]->getAmount(), $product->getPrice());
    <tr>
        <td><?=$product->getName();?></td>
        <td><?=$shoppingCart[0]->getAmount();?></td>
        <td>&#8364;<?=$product->getPrice();?></td>
        <td><?=$product->calculateTotalPriceForProduct($shoppingCart[0]->getAmount(), $product->getPrice());?></td>
    </tr>
    <?php } ?>
    <tr>
        <td colspan='3'>Subtotal</td>
        <td>&#8364;<?=$subtotal?></td>
    </tr>
    <tr>
        <td colspan='3'>Tax</td>
        <td>&#8364;<?=$product->calculateVat($subtotal)?></td>
    </tr>
    <tr>
        <td colspan='3' style='color:#ff6600;  font-weight: bold;'>TOTAL</td>

        <td style='color:#ff6600;  font-weight: bold;'> &#8364;<?=$product->calculateTotal($subtotal, $product->calculateVat($subtotal))?></td>
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
        $orderId = $_GET['order_id'];
        $invoicePdf = $pdfService->createPDF($orderId, $_SESSION['user_id'], $html);


        /*$message .= nl2br("Product: ". $amounts[$i] . "x" . $merged_products[$i]->getName() . "(€". $merged_products[$i]->getPrice() . ")\n");
        $message .= nl2br("Time: " . $merged_products[$i]->getStartTime() . "\n");
        $message .= nl2br("Location: " . $merged_products[$i]->getLocation() . "\n");
        $message .= nl2br("\n");
    }

    $message .= nl2br("\n");
    $message .= nl2br("Total: " . "€" . $totalPrice . "\n");
    $message .= nl2br("We hope you enjoyed our services, and looking forward to seeing you again!");*/
    
    $smtpService->sendEmail($email, $fullName, $message, $subject, $invoicePdf);

    //$shoppingCartService->removeCartFromUser($_SESSION['user_id']);
    header("Location: http://localhost/");
} else {
    echo "Payment Failed...";
}
?>