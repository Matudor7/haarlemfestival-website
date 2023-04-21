<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../Models/Order.php';
class OrderRepository extends Repository{
    public function getAll(){
        try{
            $statement = $this->connection->prepare("SELECT order_id, payment_id, invoice_date, invoice_number, list_Restaurant_Product_id, list_Dance_Product_id, list_Tour_Product_id FROM order");

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
            $statement = $this->connection->prepare("SELECT order_id, payment_id, invoice_date, invoice_number, list_Restaurant_Product_id, list_Dance_Product_id, list_Tour_Product_id FROM order WHERE id=:id");
            $statement->bindParam(':id', $id);

            $statement->execute();
            $order = $statement->fetchAll(PDO::FETCH_CLASS, 'Order');

            return $order;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
