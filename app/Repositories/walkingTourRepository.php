<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/WalkingTourModel.php';

class walkingTourRepository extends Repository{

    public function getAllWalkingTours(){

        $query = "SELECT walkingTour_eventId, 
        walkingTour_capacity, walkingTour_availability, walkingTour_duration, 
        walkingTour_startingLocationId, walkingTour_priceId, walkingTour_timetableId, 
        walkingTour_languageId 
        FROM walkingTour";

        try{
            $statement = $this->connection->prepare($query);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'WalkingTourModel');
            $walkingTours = $statement->fetchAll();

            return $walkingTours;
        }catch(PDOException $e){
            echo $e;
        }
    }

    public function getWalkingTourById(int $id){

        $query = "SELECT walkingTour_eventId, 
        walkingTour_capacity, walkingTour_availability, walkingTour_duration, 
        walkingTour_startingLocationId, walkingTour_priceId, walkingTour_timetableId, 
        walkingTour_languageId 
        FROM walkingTour WHERE walkingTour_eventId = :walkingTour_eventId";

        try{
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':walkingTour_eventId', $id);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'WalkingTourModel');
            $walkingTour = $statement->fetch();

            return $walkingTour;
        }catch(PDOException $e){
            echo $e;
        }
    }

    public function getWalkingTourByLanguage(int $lanuageId){

        $query = "SELECT walkingTour_eventId, 
        walkingTour_capacity, walkingTour_availability, walkingTour_duration, 
        walkingTour_startingLocationId, walkingTour_priceId, walkingTour_timetableId, 
        walkingTour_languageId 
        FROM walkingTour WHERE walkingTour_languageId = :walkingTour_languageId";
        
        try{
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':walkingTour_languageId', $lanuageId);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'WalkingTourModel');
            $walkingTour = $statement->fetch();

            return $walkingTour;
        }catch(PDOException $e){
            echo $e;
        }
    }
}
?>