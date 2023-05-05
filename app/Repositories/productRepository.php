<?php
//Tudor Nosca (678549)
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/productModel.php';

class ProductRepository extends Repository{
    public function getAll(){
        try{
            $statement = $this->connection->prepare("SELECT id, name, event_type, starting_time, location, price, available_seats FROM product");

            $statement->execute();
            $products = $statement->fetchAll(PDO::FETCH_CLASS, 'Product');

            return $products;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getById(int $id){
        try{
            $statement = $this->connection->prepare("SELECT id, name, event_type, starting_time, location, price, available_seats FROM product WHERE id=:id");
            $statement->bindParam(':id', $id);

            $statement->execute();
            $product = $statement->fetchAll(PDO::FETCH_CLASS, 'Product');

            return $product[0];
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getByEventType($eventTypeId){
        try{
            $statement = $this->connection->prepare("SELECT id, name, event_type, starting_time, location, price, available_seats FROM product WHERE event_type=:eventType");
            $statement->bindParam(':eventType', $eventTypeId);

            $statement->execute();
            $product = $statement->fetchAll(PDO::FETCH_CLASS, 'Product');

            return $product;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function updateProductAvailability($productId, $amount){

        $query = "UPDATE product SET available_seats = :availableSeats WHERE id = :id";

        try{
            $availability = $this->getById($productId)->getAvailableSeats();

            if ($availability <= 0) {
                $availableSeats = 0;
            } else {
                $availableSeats = $availability - $amount;
            }

            $statement = $this->connection->prepare($query);

            $statement->bindParam(':availableSeats', $availableSeats, PDO::PARAM_INT);
            $statement->bindParam(':id', $productId, PDO::PARAM_INT);

            $statement->execute();

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}

?>