<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../Models/RestaurantRating.php';

class RatingRepository extends Repository
{


    public function getAllRating()
    {
        try {
            $statement = $this->connection->prepare("SELECT restaurantRating_id, ratingNumber FROM restaurantRating");
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'RestaurantRating');
            $rating = $statement->fetchAll();

            return $rating;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getRatingByID($id)
    {
        try {
            $statement = $this->connection->prepare("SELECT restaurantRating_id, ratingNumber FROM restaurantRating where restaurantRating_id =:id");
            $statement->bindParam(':id', $id);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'RestaurantRating');
            $rating = $statement->fetch();

            return $rating;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}