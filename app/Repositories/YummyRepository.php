<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/RestaurantModel.php';

class YummyRepository extends Repository
{
    public function getAll()
    {
        try {
            $statement = $this->connection->prepare("SELECT restaurant_id, restaurant_name	, restaurant_title, restaurant_kidsPrice,
       restaurant_adultsPrice, restaurant_OpeningTime, restaurant_numberOfAvailableSeats, numberOfTimeSlots, duration,
       restaurant_isItAvailable, restaurant_addressId, havaDetailPageOrNot, detail_id, restaurant_pictureURL, restaurant_foodType, restaurant_rating, contactInf_id
FROM restaurant");
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'RestaurantModel');
            $restaurants = $statement->fetchAll();

            return $restaurants;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getByName(string $name)
    {
        try {
            $statement = $this->connection->prepare("SELECT restaurant_id, restaurant_name, restaurant_kidsPrice, restaurant_adultsPrice, restaurant_OpeningTime, restaurant_numberOfAvailableSeats, numberOfTimeSlots, duration, restaurant_isItAvailable, restaurant_addressId, restaurant_rating, restaurant_pictureURL, restaurant_foodType  FROM restaurant WHERE restaurant_name = :restaurant_name");
            //TODO make sure that the name comes from a dropdown option no input from the user
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'Restaurant');

            $restaurant = $statement->fetch();

            return $restaurant;
        } catch (PDOEXCEPTION $e) {
            echo $e;
        }
    }

    public function getById($restaurant_id)
    {
            try {
                $statement = $this->connection->prepare("SELECT restaurant_id, restaurant_name	, restaurant_title, restaurant_kidsPrice,
       restaurant_adultsPrice, restaurant_OpeningTime, restaurant_numberOfAvailableSeats, numberOfTimeSlots, duration,
       restaurant_isItAvailable, restaurant_addressId, havaDetailPageOrNot, detail_id, restaurant_pictureURL, restaurant_foodType, restaurant_rating, contactInf_id
FROM restaurant WHERE restaurant_id = :restaurant_id");
                //TODO make sure that the name comes from a dropdown option no input from the user
                $statement->bindParam(':restaurant_id', $restaurant_id);
                $statement->execute();
                $statement->setFetchMode(PDO::FETCH_CLASS, 'RestaurantModel');

                $restaurant = $statement->fetch();

                return $restaurant;
            } catch (PDOEXCEPTION $e) {
                echo $e;
            }

    }


}
