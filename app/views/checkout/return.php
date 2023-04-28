<?php
require_once __DIR__ . '/../../Services/paymentService.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__. '/../../Models/Order.php';
require_once __DIR__ . '/../../Services/pdfGenerator.php';
require_once __DIR__ . '/../../Services/smtpService.php';


$paymentService = new PaymentService();
$paymentObject = $paymentService->getByUserId($_SESSION['user_id']);

$mollie = new Mollie\Api\MollieApiClient();
$mollie->setApiKey('test_mgqJkkMVNtskk2e9vpgsBhUPsTj9K4');

$payment = $mollie->payments->get($paymentObject->getPaymentId());

if ($payment->isPaid()) {
    //TODO move the logic to the controller
     $order = new order();
     //$smtpService = new smtpService();

    $order->setInvoiceDate();
    $order->setInvoiceNumber();
    $order->setListProductId("1,2,3");
    $order->setOrderId(1);
    $order->setPaymentId(1);
    //if(shoppingCart.productId is of type dance){
    //
    //  order-->music_product_list = shoppingCart.productId; + ","  + the next product from this type; }
    //else if(shoppingCart.productId is of type restaurant){
    // order-->restaurant_product_list = shoppingCart.productId; + ","  + the next product from this type restaurant_product_list_id}
    
    //add to the order to the order table
    //$shoppingCart = $shoppingCartService->getCartOfUser($_SESSION['user_id']);

    $email = $paymentObject->getEmail();
    $fullName = $paymentObject->getFullName();

    $subject = "Your Haarlem Festival Order Invoice";

   // $message = nl2br("Hello, " . $paymentObject->getFirstName() . ".\n");
    //$message .= nl2br("Here your order invoice: \n");

        $message = "Here is your invoice, thanks for buying your ticket with us!!!";
        $pdfService = new PDFGenerator();
        $html = "<html>
<head>
	<title>Invoice</title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}
		th, td {
			border: 1px solid black;
			padding: 8px;
			text-align: left;
		}
		th {
			background-color: #f2f2f2;
		}
	</style>
</head>
<body>
	<h1>Invoice</h1>
	<table>
		<thead>
			<tr>
				<th>Description</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Product 1</td>
				<td>2</td>
				<td>$10</td>
				<td>$20</td>
			</tr>
			<tr>
				<td>Product 2</td>
				<td>1</td>
				<td>$25</td>
				<td>$25</td>
			</tr>
			<tr>
				<td colspan='3'>Subtotal</td>
				<td>$45</td>
			</tr>
			<tr>
				<td colspan='3'>Tax</td>
				<td>$4.50</td>
			</tr>
			<tr>
				<td colspan='3'>Total</td>
				<td>$49.50</td>
			</tr>
		</tbody>
	</table>
</body>
</html> ";
        $invoicePdf = $pdfService->createPDF($order->getOrderId(), $_SESSION['user_id'], $html);


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