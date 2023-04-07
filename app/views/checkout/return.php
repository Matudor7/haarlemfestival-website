<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$mollie = new Mollie\Api\MollieApiClient();
$mollie->setApiKey('test_mgqJkkMVNtskk2e9vpgsBhUPsTj9K4');

$payment = $mollie->payments->get($_GET['id']);

if ($payment->isPaid()) {
    echo "Payment Succeeded!";
    header("Location: /");
} else {
    echo "Payment Failed...";
}
?>