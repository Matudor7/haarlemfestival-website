<?php
require __DIR__ . '/../../Services/paymentService.php';
require __DIR__ . '/../../Models/paymentModel.php';

class CheckoutController{
    private $paymentService;

    function __construct(){
        $this->paymentService = new PaymentService();
    }

    function index(){
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($this->paymentService->getAll());
        }

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $paymentJsonString = file_get_contents('php://input');

            $paymentData = json_decode($paymentJsonString, true);

            $payment = new Payment();

            $payment->setUserid($_SESSION["user_id"]);
            $payment->setFirstName($paymentData["first_name"]);
            $payment->setLastName($paymentData["last_name"]);
            $payment->setEmail($paymentData["email"]);
            $payment->setAddress($paymentData["address"]);
            $payment->setZip($paymentData["zip"]);
            $payment->setPaymentMethod($paymentData["payment_method"]);
            $payment->setCardName($paymentData["card_name"]);
            $payment->setCardNumber($paymentData["card_number"]);
            $payment->setCardExpiration($paymentData["card_expiration"]);
            $payment->setCvv($paymentData["CVV"]);
        }
    }
}
?>