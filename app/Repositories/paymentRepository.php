<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/paymentModel.php';

class PaymentRepository extends Repository{

    public function getAll(){
        try{
            $statement = $this->connection->prepare("SELECT id, user_id, first_name, last_name, email, address, zip, payment_method, card_name, card_number, card_expiration, CVV, total FROM payment_details");

            $statement->execute();
            $payment_details = $statement->fetchAll(PDO::FETCH_CLASS, 'Payment');

            return $payment_details;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function insert($payment){
        try{
            $statement = $this->connection->prepare("INSERT into payment_details (user_id, first_name, last_name, email, address, zip, payment_method, card_name, card_number, card_expiration, CVV, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $statement->execute(array($payment->getUserId(), htmlspecialchars($payment->getFirstName()), htmlspecialchars($payment->getLastName()),htmlspecialchars($payment->getEmail()), htmlspecialchars($payment->getAddress()), htmlspecialchars($payment->getZip()), htmlspecialchars($payment->getPaymentMethod()), htmlspecialchars($payment->getCardName()), htmlspecialchars($payment->getCardNumber()), htmlspecialchars($payment->getCardExpiration()), htmlspecialchars($payment->getCvv()), $payment->getTotal()));
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

}
?>