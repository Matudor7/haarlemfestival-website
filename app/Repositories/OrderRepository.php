<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../Models/Order.php';
class OrderRepository extends Repository{
    public function getAll(){
        try{
            $statement = $this->connection->prepare("SELECT order_id, payment_id, invoice_date, invoice_number, list_Product_id, payment_status FROM `order`");

            $statement->execute();
            $orders = $statement->fetchAll(PDO::FETCH_CLASS, 'Order');

            return $orders;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getById(int $id)
    {
        try {
            $statement = $this->connection->prepare("SELECT order_id, payment_id, invoice_date, invoice_number, list_Product_id, payment_status FROM `order` WHERE order_id=:id");
            $statement->bindParam(':id', $id);

            $statement->execute();
            $order = $statement->fetchAll(PDO::FETCH_CLASS, 'Order');

            return $order;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insertOrder($order)
    {
        try {
            $statement = $this->connection->prepare("INSERT INTO `order` ( payment_id, invoice_date, invoice_number, list_Product_id, payment_status) VALUES ( :payment_id, :invoice_date, :invoice_number, :list_Product_id, :payment_status)");
           $paymentId = $order->getPaymentId();
           $invoiceDate = $order->getInvoiceDate();
           $invoiceNumber = $order->getInvoiceNumber();
           $listProductId = $order->getListProductId();
           $paymentStatus = htmlspecialchars($order->getPaymentStatus());
           $statement->bindParam(':payment_id',$paymentId );
           $statement->bindParam(':invoice_date', $invoiceDate);
            $statement->bindParam(':invoice_number', $invoiceNumber);
            $statement->bindParam(':list_Product_id', $listProductId);
            $statement->bindParam(':payment_status', $paymentStatus);

            $statement->execute();

            return $this->getById($this->connection->lastInsertId());
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function changePaymentStatus($order_id, $payment_status){
        try{
            $statement = $this->connection->prepare("UPDATE `order` SET payment_status=:paymentStatus WHERE order_id=:orderId");
            $sanitizedStatus = htmlspecialchars($payment_status);
    
            $statement->bindParam(':paymentStatus', $payment_status);
            $statement->bindParam(':orderId', $order_id);
    
            $statement->execute();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function addPaymentId($paymentId, $orderId){
        try{
            $statement = $this->connection->prepare("UPDATE `order` SET payment_id=:paymentId WHERE order_id=:orderId");
            $statement->bindParam(':paymentId', $paymentId);
            $statement->bindParam(':orderId', $orderId);

            $statement->execute();
            return $this->getById($orderId);
        }catch(PDOException $e){
            echo $e->getMessage();
        }

    }
}
