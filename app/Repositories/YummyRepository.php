<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/RestaurantModel.php';

class YummyRepository extends Repository
{
    public function getAll()
    {
        try {
            $statement = $this->connection->prepare("SELECT restaurant_id, restaurant_name, restaurant_kidsPrice,
       restaurant_adultsPrice, restaurant_OpeningTime, restaurant_numberOfAvailableSeats, numberOfTimeSlots, duration,
       restaurant_isItAvailable, restaurant_addressId, havaDetailPageOrNot, detail_id, restaurant_pictureURL, foodType_id, restaurantRating_id, contactInf_id
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
            $statement = $this->connection->prepare("SELECT restaurant_id, restaurant_name	,  restaurant_kidsPrice,
       restaurant_adultsPrice, restaurant_OpeningTime, restaurant_numberOfAvailableSeats, numberOfTimeSlots, duration,
       restaurant_isItAvailable, restaurant_addressId, havaDetailPageOrNot, detail_id, restaurant_pictureURL, foodType_id, restaurant_rating, contactInf_id
FROM restaurant WHERE restaurant_name = :restaurant_name");
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
            $statement = $this->connection->prepare("SELECT restaurant_id, restaurant_name	,  restaurant_kidsPrice,
       restaurant_adultsPrice, restaurant_OpeningTime, restaurant_numberOfAvailableSeats, numberOfTimeSlots, duration,
       restaurant_isItAvailable, restaurant_addressId, havaDetailPageOrNot, detail_id, restaurant_pictureURL, foodType_id, restaurantRating_id, contactInf_id
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

    public function insertRestaurant($restaurant)
    {
        try {
            $statement = $this->connection->prepare("INSERT INTO restaurant (restaurant_name, 
                        restaurant_kidsPrice, restaurant_adultsPrice, restaurant_OpeningTime, restaurant_numberOfAvailableSeats, 
                        numberOfTimeSlots, duration,  havaDetailPageOrNot,
                       restaurant_pictureURL, foodType_id, restaurantRating_id) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $statement->execute(array(
                htmlspecialchars($restaurant->getRestaurantName()),
                htmlspecialchars($restaurant->getRestaurantKidsPrice()),
                htmlspecialchars($restaurant->getRestaurantAdultsPrice()),
                htmlspecialchars($restaurant->getRestaurantOpeningTime()),
                htmlspecialchars($restaurant->getRestaurantNumberOfAvailableSeats()),
                htmlspecialchars($restaurant->getNumberOfTimeSlots()),
                htmlspecialchars($restaurant->getDuration()),
                htmlspecialchars($restaurant->getHavaDetailPageOrNot()),
                htmlspecialchars($restaurant->getRestaurantPictureURL()),
                htmlspecialchars($restaurant->getFoodTypeId()),
                htmlspecialchars($restaurant->getRestaurantRatingId()),

            ));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateRestaurant($restaurant)
    {
        try {
            $statement = $this->connection->prepare("UPDATE restaurant SET 
    restaurant_name = :restaurantName, 
    restaurant_kidsPrice = :restaurantKidsPrice,
    restaurant_adultsPrice = :restaurantAdultsPrice, 
    restaurant_OpeningTime = :restaurantOpeningTime, 
    restaurant_numberOfAvailableSeats = :restaurantNumberOfAvailableSeats,
    numberOfTimeSlots = :numberOfTimeSlots, 
    duration = :duration, 
    havaDetailPageOrNot = :havaDetailPageOrNot, 
    restaurant_pictureURL = :restaurantPictureURL, 
    foodType_id = :restaurantFoodType, 
    restaurantRating_id = :restaurantRatingId 
    WHERE restaurant_id = :restaurantId");

            $restaurantName = $restaurant->getRestaurantName();
            $restaurantKidsPrice = $restaurant->getRestaurantKidsPrice();
            $restaurantAdultsPrice = $restaurant->getRestaurantAdultsPrice();
            $restaurantOpeningTime = $restaurant->getRestaurantOpeningTime();
            $restaurantNumberOfAvailableSeats = $restaurant->getRestaurantNumberOfAvailableSeats();
            $numberOfTimeSlots = $restaurant->getNumberOfTimeSlots();
            $duration = $restaurant->getDuration();
            $havaDetailPageOrNot = $restaurant->getHavaDetailPageOrNot();
            $restaurantPictureURL = $restaurant->getRestaurantPictureURL();
            $restaurantFoodType = $restaurant->getFoodTypeId();
            $restaurantRatingId = $restaurant->getRestaurantRatingId();
            $restaurantId = $restaurant->getRestaurantId();

            $statement->bindParam(':restaurantName', $restaurantName);
            $statement->bindParam(':restaurantKidsPrice', $restaurantKidsPrice);
            $statement->bindParam(':restaurantAdultsPrice', $restaurantAdultsPrice);
            $statement->bindParam(':restaurantOpeningTime', $restaurantOpeningTime);
            $statement->bindParam(':restaurantNumberOfAvailableSeats', $restaurantNumberOfAvailableSeats);
            $statement->bindParam(':numberOfTimeSlots', $numberOfTimeSlots);
            $statement->bindParam(':duration', $duration);
            $statement->bindParam(':havaDetailPageOrNot', $havaDetailPageOrNot);
            $statement->bindParam(':restaurantPictureURL', $restaurantPictureURL);
            $statement->bindParam(':restaurantFoodType', $restaurantFoodType);
            $statement->bindParam(':restaurantRatingId', $restaurantRatingId);
            $statement->bindParam(':restaurantId', $restaurantId);

            return $statement->execute();
        } catch (PDOException $e) {
            throw new Exception("Error updating restaurant: " . $e->getMessage());
        }
    }


    public function deleteRestaurant($restaurantId) {
        try {
            $statement = $this->connection->prepare("DELETE FROM restaurant WHERE restaurant_id = :restaurantId");
            $statement->bindParam(':restaurantId', $restaurantId);
            $statement->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

}
