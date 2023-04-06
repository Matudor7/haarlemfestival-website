<?php
require __DIR__ . '/../Repositories/paymentRepository.php';

class PaymentService{
    public function getAll(){
        $paymentRepo = new PaymentRepository();
        $payments = $paymentRepo->getAll();

        return $payments;
    }

    public function insert($payment){
        $paymentRepo = new PaymentRepository();
        $paymentRepo->insert($payment);
    }
}
?>