<?php
require_once __DIR__ . '/vendor/autoload.php';

$webhookData = file_get_contents('php://input');
$webhookData = json_decode($webhookData, true);

$paymentId = $webhookData['id'];

$mollie = new \Mollie\Api\MollieApiClient();
$mollie->setApiKey('test_mgqJkkMVNtskk2e9vpgsBhUPsTj9K4'); 
$payment = $mollie->payments->get($paymentId);


if ($payment->isPaid()) {
    //Invoice location
    echo "Paid Payment";
} elseif ($payment->isOpen()) {
    echo "Open Payment";
} else {
    //error handling
    echo "Failed Payment";
}

http_response_code(200);