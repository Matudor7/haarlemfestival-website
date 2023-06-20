<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../Models/OrderedProducts.php';
class OrderedProductsRepository extends Repository{
    public function getAll(){
        try{
            $statement = $this->connection->prepare("SELECT id, productId, orderId,amount FROM `OrderedProducts`");

            $statement->execute();
            $orders = $statement->fetchAll(PDO::FETCH_CLASS, 'OrderedProducts');

            return $orders;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getByOrderId(int $orderId)
    {
        try {
            $statement = $this->connection->prepare("SELECT id, productId, orderId,amount FROM `OrderedProducts` WHERE orderId=:id");
            $statement->bindParam(':id', $orderId);

            $statement->execute();
            $order = $statement->fetchAll(PDO::FETCH_CLASS, 'OrderedProducts');

            return $order;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function addOrderedProduct(int $productId, int $orderId, int $amount){
        try{
            $statement = $this->connection->prepare("INSERT INTO `OrderedProducts` (productId, orderId, amount) VALUES (:productId, :orderId, :amount)");
            $statement->bindParam(':productId', $productId);
            $statement->bindParam(':orderId', $orderId);
            $statement->bindParam(':amount', $amount);

            $statement->execute();

            return $this->getByOrderId($this->connection->lastInsertId());
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

}