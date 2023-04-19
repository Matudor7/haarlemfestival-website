<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../Models/WalkingTourModel.php';
require __DIR__ . '/../Models/TourPrice.php';
require __DIR__ . '/../Models/TourTimetable.php';
require __DIR__ . '/../Models/TourLocation.php';
require __DIR__ . '/../Models/TourLanguage.php';

class walkingTourRepository extends Repository{

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
        }catch(PDOException $e){echo $e;}
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
        }catch(PDOException $e){echo $e;}
    }

    public function getTourPrices()
    {

        $query = "SELECT walkingTour_Price_id, walkingTour_Price_price, walkingTour_Price_description, 	walkingTour_Price_amoutofPeople
        FROM walkingTour_Price";

        try {
            $statement = $this->connection->prepare($query);
            $statement->execute();

            $prices = $statement->fetchAll(PDO::FETCH_CLASS, 'TourPrice');

            return $prices;
        } catch (PDOException $e) {echo $e;}
    }
    public function getTourPriceById(int $id){
        $query ="SELECT walkingTour_Price_id, walkingTour_Price_price, walkingTour_Price_description, 
       walkingTour_Price_amoutofPeople FROM walkingTour_Price WHERE walkingTour_Price_id = :id";

        try{
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'TourPrice');
            $tourPrice = $statement->fetch();

            return $tourPrice;
        } catch (PDOException $e){echo $e;}
    }
public function getTourLanguages()
{
    $query = "SELECT walkingTour_Language_id, walkingTour_Language_language FROM walkingTour_Language";

    try {
        $statement = $this->connection->prepare($query);
        $statement->execute();

        $languages = $statement->fetchAll(PDO::FETCH_CLASS, 'TourLanguage');

        return $languages;
    } catch (PDOException $e) {echo $e;}
}
    public function getTourLanguageById(int $id){
        $query ="SELECT walkingTour_Language_id, walkingTour_Language_language FROM walkingTour_Language WHERE walkingTour_Language_id = :id";

        try{
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'TourLanguage');
            $tourLanguage = $statement->fetch();

            return $tourLanguage;
        } catch (PDOException $e){echo $e;}
    }

    public function getTourLocations(){
            
            $query = "SELECT walkingTour_Locations_id, walkingTour_Locations_venueName, walkingTour_Locations_addresId
            FROM walkingTour_Locations";
    
            try{
                $statement = $this->connection->prepare($query);
                $statement->execute();
    
                $locations = $statement->fetchAll(PDO::FETCH_CLASS, 'TourLocation');
                return $locations;
            }catch(PDOException $e){echo $e;}
    }

    public function getTourLocationById(int $id){
        $query = "SELECT walkingTour_Locations_id, walkingTour_Locations_venueName, walkingTour_Locations_addresId
            FROM walkingTour_Locations WHERE walkingTour_Locations_id = :id";

        try{
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'TourLocation');
            $tourLocation = $statement->fetch();

            return $tourLocation;
        }
        catch(PDOException $e){echo $e;}
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
    }
            return $timetables;
    } catch (PDOException $e) {echo $e;}
}
public function getTourTimetableById(int $id){
    $query = "SELECT walkingTour_Timetable_id, walkingTour_Timetable_startingDate, walkingTour_Timetable_startingTime
            FROM walkingTour_Timetable WHERE walkingTour_Timetable_id = :id";

    try{
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

            $timetable = new TourTimetable();
            $timetable->setTimetableId($row['walkingTour_Timetable_id']);

            $dateTime_string = $row['walkingTour_Timetable_startingDate'].' '.$row['walkingTour_Timetable_startingTime'];

            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateTime_string);
            $timetable->setTimetableStartDateTime($dateTime);

            return $timetable;
        }
    }
    catch(PDOException $e){echo $e;}
}

    public function getAllWalkingTours(){
        $query = "SELECT walkingTour_eventId, walkingTour_capacity, walkingTour_availability, walkingTour_duration, 
        walkingTour_startingLocationId, walkingTour_priceId, walkingTour_timetableId, WalkingTour_languageId
        FROM walkingTour";

        try{
            $statement = $this->connection->prepare($query);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                $walkingTour = new WalkingTourModel();
                $walkingTour->setEventId($row['walkingTour_eventId']);
                $walkingTour->setTourCapacity($row['walkingTour_capacity']);
                $walkingTour->setTourAvailability($row['walkingTour_availability']);
                $walkingTour->setStartLocation($this->getTourLocationById($row['walkingTour_startingLocationId']));
                $walkingTour->setTourPrice($this->getTourPriceById($row['walkingTour_priceId']));
                $walkingTour->setTourTimetable($this->getTourTimetableById($row['walkingTour_timetableId']));
                $walkingTour->setTourDuration($row['walkingTour_duration']);
                $walkingTour->setTourLanguage($this->getTourLanguageById($row['WalkingTour_languageId']));

                $walkingTours[] = $walkingTour;
            }

            return $walkingTours;

        } catch(PDOException $e){echo $e;}
    }

    public function getContentTextByElement(string $elementId){
        $query = "SELECT text FROM walkingTour_content WHERE element_Id = :elementId";

        try{
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':elementId', $elementId);
            $statement->execute();

            $text = $statement->fetchColumn();
            return $text;
        }
        catch(PDOException $e){echo $e;}
    }
    public function getContentTitleByElement(string $elementId){
        $query = "SELECT title FROM walkingTour_content WHERE element_Id = :elementId";

        try{
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':elementId', $elementId);
            $statement->execute();

            $title = $statement->fetchColumn();
            return $title;
        }
        catch(PDOException $e){echo $e;}
    }
    public function getContentButtonTextByElement(string $elementId){
        $query = "SELECT button_text FROM walkingTour_content WHERE element_Id = :elementId";

        try{
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':elementId', $elementId);
            $statement->execute();

            $bText = $statement->fetchColumn();
            return $bText;
        }
        catch(PDOException $e){echo $e;}
    }
}
?>