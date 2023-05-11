<?php
//Tudor Nosca (678549)
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../Models/paymentModel.php';

class PaymentRepository extends Repository{

    public function getAll(){
        try{
            $statement = $this->connection->prepare("SELECT id, user_id, first_name, last_name, email, address, zip, phone_number, payment_method, total, payment_id FROM payment_details");

            $statement->execute();
            $payment_details = $statement->fetchAll(PDO::FETCH_CLASS, 'PaymentDetailsModel');

            return $payment_details;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getByUserId($user_id){
        try{
            $statement = $this->connection->prepare("SELECT id, user_id, first_name, last_name, email, address, zip, phone_number, payment_method, total, payment_id FROM payment_details WHERE user_id=:userId");

            $statement->bindParam(':userId', $user_id);
                        
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'PaymentDetailsModel');

            $payment_details = $statement->fetch();

            return $payment_details;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    //Ale get by paymentID
    public function getByPaymentId($id){
        try{
            $statement = $this->connection->prepare("SELECT id, user_id, first_name, last_name, email, address, zip, phone_number, payment_method, card_name, card_number, card_expiration, CVV, total, payment_id FROM payment_details WHERE user_id=:userId");

            $statement->bindParam(':id', $id);

            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'PaymentDetailsModel');

            $payment_details = $statement->fetch();

            return $payment_details;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function insert($payment){
        try{
            $statement = $this->connection->prepare("INSERT into payment_details (user_id, first_name, last_name, email, address, zip, phone_number, payment_method, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $statement->execute(array($payment->getUserId(), htmlspecialchars($payment->getFirstName()), htmlspecialchars($payment->getLastName()),htmlspecialchars($payment->getEmail()), htmlspecialchars($payment->getAddress()), htmlspecialchars($payment->getZip()),  htmlspecialchars($payment->getPhoneNumber()) , htmlspecialchars($payment->getPaymentMethod()), $payment->getTotal()));
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }


    public function addPaymentId($user_id, $paymentId){
        try{
            $statement = $this->connection->prepare("UPDATE payment_details SET payment_id=:paymentId WHERE user_id=:userId");
            $sanitizedId = htmlspecialchars($paymentId);
    
            $statement->bindParam(':userId', $user_id);
            $statement->bindParam('paymentId', $sanitizedId);
    
            $statement->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

}
?>