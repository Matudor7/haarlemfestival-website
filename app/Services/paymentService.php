<?php
require __DIR__ . '/../Repositories/paymentRepository.php';

class PaymentService{
    public function getAll(){
        $paymentRepo = new PaymentRepository();
        $payments = $paymentRepo->getAll();

        return $payments;
    }

    public function insert(int $user_id, $payment){
        $paymentRepo = new PaymentService();
        $paymentRepo->insert($user_id, $payment);
    }
}
?>