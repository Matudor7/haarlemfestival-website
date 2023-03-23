<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../Models/FoodType.php';
class FoodTypeRepository extends Repository
{
    public function getAllTypes()
    {
        try {
            $statement = $this->connection->prepare("SELECT foodType_id, foodType FROM restaurant_foodType");
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'FoodType');
            $foodType = $statement->fetchAll();

            return $foodType;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getFoodTypeByID($id)
    {
        try {
            $statement = $this->connection->prepare("SELECT foodType_id, foodType FROM restaurant_foodType where foodType_id =:id");
            $statement->bindParam(':id', $id);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'FoodType');
            $foodType = $statement->fetch();

            return $foodType;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}