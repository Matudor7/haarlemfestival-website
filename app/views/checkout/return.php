<?php
//Tudor Nosca (678549)
require_once __DIR__ . '/../../Services/paymentService.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$paymentService = new PaymentService();
$paymentObject = $paymentService->getByUserId($_SESSION['user_id']);

$mollie = new Mollie\Api\MollieApiClient();
$mollie->setApiKey('test_mgqJkkMVNtskk2e9vpgsBhUPsTj9K4');

$payment = $mollie->payments->get($paymentObject->getPaymentId());

if ($payment->isPaid()) {
    $shoppingCart = $shoppingCartService->getCartOfUser($_SESSION['user_id']);

    $email = $paymentObject->getEmail();
    $lastName = $paymentObject->getLastName();
    $subject = "Your Haarlem Festival Order Invoice";

    $message = nl2br("Hello, " . $paymentObject->getFirstName() . ".\n");
    $message .= nl2br("Here your order invoice: \n");
    for($i = 0; $i < count($merged_products); $i++){
        $message .= nl2br("Product: ". $amounts[$i] . "x" . $merged_products[$i]->getName() . "(€". $merged_products[$i]->getPrice() . ")\n");
        $message .= nl2br("Time: " . $merged_products[$i]->getStartTime() . "\n");
        $message .= nl2br("Location: " . $merged_products[$i]->getLocation() . "\n");
        $message .= nl2br("\n");

    }

    $message .= nl2br("\n");
    $message .= nl2br("Total: " . "€" . $totalPrice . "\n");
    $message .= nl2br("We hope you enjoyed our services, and looking forward to seeing you again!");
    
    $smtpService->sendEmail($email, $lastName, $message, $subject);

    $shoppingCartService->removeCartFromUser($_SESSION['user_id']);
    header("Location: http://localhost/");
} else {
    echo "Payment Failed...";
}
?>