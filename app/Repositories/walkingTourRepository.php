<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../Models/WalkingTourModel.php';
require __DIR__ . '/../Models/TourPrice.php';
require __DIR__ . '/../Models/TourTimetable.php';
require __DIR__ . '/../Models/TourLocation.php';
require __DIR__ . '/../Models/TourLanguage.php';

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

    public function getTourPrices(){

        $query = "SELECT walkingTour_Price_id, walkingTour_Price_price, walkingTour_Price_description, 	walkingTour_Price_amoutofPeople
        FROM walkingTour_Price";

        try{
            $statement = $this->connection->prepare($query);
            $statement->execute();

            $prices = $statement->fetchAll(PDO::FETCH_CLASS, 'TourPrice');

            return $prices;
        }catch(PDOException $e){
            echo $e;
        }
    }

    public function getTourLocations(){
            
            $query = "SELECT walkingTour_Locations_id, walkingTour_Locations_venueName, walkingTour_Locations_addresId
            FROM walkingTour_Locations";
    
            try{
                $statement = $this->connection->prepare($query);
                $statement->execute();
    
                $locations = $statement->fetchAll(PDO::FETCH_CLASS, 'TourLocation');
                return $locations;
            }catch(PDOException $e){
                echo $e;
            }
    }

    public function getTourTimetable2(){
        $query = "SELECT walkingTour_Timetable_id, walkingTour_Timetable_startingDate, 
       walkingTour_Timetable_startingTime FROM walkingTour_Timetable";

        try{
            $statement = $this->connection->prepare($query);
            $statement->execute();

        } catch(PDOException $e){
            echo $e;
        }
    }
    public function getTourTimetable(){
        $query = "SELECT walkingTour_Timetable_id, walkingTour_Timetable_startingDate, 
       walkingTour_Timetable_startingTime FROM walkingTour_Timetable";

        try{
        $statement = $this->connection->prepare($query);
        $statement->execute();

        $timetables = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

            $timetable = new TourTimetable();
            $timetable->setTimetableId($row['walkingTour_Timetable_id']);
            $date = $row['walkingTour_Timetable_startingDate'];
            $time = $row['walkingTour_Timetable_startingTime'];

            $dateTime_string = $row['walkingTour_Timetable_startingDate'].' '.$row['walkingTour_Timetable_startingTime'];

            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateTime_string);
            $timetable->setTimetableStartDateTime($dateTime);

            $timetables[] = $timetable;
            return $timetables;
    }
    } catch (PDOException $e) {
error_log('Error retrieving dance events: ' . $e->getMessage());
return [];
}
}
}
?>