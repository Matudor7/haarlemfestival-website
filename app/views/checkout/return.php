<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$mollie = new Mollie\Api\MollieApiClient();
$mollie->setApiKey('test_mgqJkkMVNtskk2e9vpgsBhUPsTj9K4');

$payment = $mollie->payments->get($paymentObject->getPaymentId());

if ($payment->isPaid()) {
    $email = $paymentObject->getEmail();
    $lastName = $paymentObject->getLastName();
    $subject = "Your Haarlem Festival Order Invoice";
    $shoppingCartService->removeCartFromUser($_SESSION['user_id']);
    header("Location: http://localhost/");
} else {
    echo "Payment Failed...";
}
?>