<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/paymentModel.php';

class PaymentRepository extends Repository{

    public function getAll(){
        try{
            $statement = $this->connection->prepare("SELECT id, user_id, email, address, zip, payment_method, card_name, card_number, card_expiration, CVV FROM payment_details");

            $statement->execute();
            $payment_details = $statement->fetchAll(PDO::FETCH_CLASS, 'Payment');

            return $payment_details;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function insert(int $user_id, $payment){
        try{
            $statement = $this->connection->prepare("INSERT into payment_details (user_id, email, address, zip, payment_method, card_name, card_number, card_expiration, CVV) VALUES (?,?,?,?,?,?,?,?,?)");
            $statement->execute(array($user_id, htmlspecialchars($payment->getEmail()), htmlspecialchars($payment->getAddress()), htmlspecialchars($payment->getZip()), htmlspecialchars($payment->getPaymentMethod()), htmlspecialchars($payment->getCardName()), htmlspecialchars($payment->getCardNumber()), htmlspecialchars($payment->getCardExpiration()), htmlspecialchars($payment->getCvv())));
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

}
?>