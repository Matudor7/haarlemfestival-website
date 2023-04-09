<?php
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
    "webhookUrl"  => "https://73ef-213-10-175-251.ngrok-free.app/checkout/webhook",
    "redirectUrl" => "https://73ef-213-10-175-251.ngrok-free.app/checkout/return",
]);

$paymentService->addPaymentId($_SESSION['user_id'], $payment->id);

header("Location: " . $payment->getCheckoutUrl());
?>