<?php
//Tudor Nosca (678549)
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
    "webhookUrl"  => "     https://3be4-31-151-76-20.ngrok-free.app/checkout/webhook",
    //"redirectUrl" => "     https://3be4-31-151-76-20.ngrok-free.app/checkout/return",
    "redirectUrl" => "     http://localhost/checkout/return?payment_id=" . $paymentId->id,
    //pass the id the references the payment, we want to be able tyo access it from other pages and access the order from it
]);

$paymentService->addPaymentId($_SESSION['user_id'], $payment->id);

header("Location: " . $payment->getCheckoutUrl());
?>