<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../Models/WalkingTourModel.php';
require __DIR__ . '/../Models/TourPrice.php';
require __DIR__ . '/../Models/TourTimetable.php';
require __DIR__ . '/../Models/TourLocation.php';
require __DIR__ . '/../Models/TourLanguage.php';
require __DIR__.'/../Models/WalkingTourContentModel.php';

class walkingTourRepository extends Repository{

    public function getWalkingTourById(int $id){

        $query = "SELECT walkingTour_eventId, 
        walkingTour_capacity, walkingTour_availability, walkingTour_duration, 
        walkingTour_startingLocationId, walkingTour_priceId, walkingTour_timetableId, 
        WalkingTour_languageId FROM walkingTour WHERE walkingTour_eventId = :walkingTour_eventId";

        try{
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':walkingTour_eventId', $id);
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

            }

            return $walkingTour;

        }catch(PDOException $e){echo $e;}
    }

    public function getAllWalkingTours(){
        $query = "SELECT walkingTour_eventId FROM walkingTour";

        try{
            $statement = $this->connection->prepare($query);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                $walkingTour = $this->getWalkingTourById($row['walkingTour_eventId']);
                $walkingTours[] = $walkingTour;
            }

            return $walkingTours;

        } catch(PDOException $e){echo $e;}
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
    public function getTourPrices()
    {

        $query = "SELECT walkingTour_Price_id FROM walkingTour_Price";

        try {
            $statement = $this->connection->prepare($query);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                $tourPrice = $this->getTourPriceById($row['walkingTour_Price_id']);
                $tourPrices[] = $tourPrice;
            }

            return $tourPrices;

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
    public function getTourLanguages(){
        $query = "SELECT walkingTour_Language_id FROM walkingTour_Language";

        try {
            $statement = $this->connection->prepare($query);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                $tourLanguage = $this->getTourLanguageById($row['walkingTour_Language_id']);
                $tourLanguages[] = $tourLanguage;
            }
            return $tourLanguages;

        } catch (PDOException $e) {echo $e;}
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
    public function getTourLocations(){
            
            $query = "SELECT walkingTour_Locations_id FROM walkingTour_Locations";
    
            try{
                $statement = $this->connection->prepare($query);
                $statement->execute();

                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                    $tourLocation = $this->getTourLocationById($row['walkingTour_Locations_id']);
                    $tourLocations[] = $tourLocation;
                }
                return $tourLocations;

            }catch(PDOException $e){echo $e;}
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

    public function getTourTimetable(){
        $query = "SELECT walkingTour_Timetable_id FROM walkingTour_Timetable";

        try{
        $statement = $this->connection->prepare($query);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

            $timetable = $this->getTourTimetableById($row['walkingTour_Timetable_id']);
            $timetables[] = $timetable;
        }
            return $timetables;

    } catch (PDOException $e) {echo $e;}
}

    public function getContentByElement(string $sectionName){
        $query = "SELECT Id, section_name, title, text, button_text, isCreated
            FROM walkingTour_content WHERE section_name = :sectionName";

        try{
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':sectionName', $sectionName);
            $statement->execute();

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                $walkingTourContent = new WalkingTourContentModel();
                $walkingTourContent->setId($row['Id']);
                $walkingTourContent->setSection($row['section_name']);
                $walkingTourContent->setIsCreated($row['isCreated']);

                if(is_null($row['text'])){
                    $walkingTourContent->setText('none');
                } else {
                    $walkingTourContent->setText($row['text']);
                }

                if(is_null($row['title'])){
                    $walkingTourContent->setTitle('none');
                } else {
                    $walkingTourContent->setTitle($row['title']);
                }

                if(is_null($row['button_text'])){
                    $walkingTourContent->setButtonText('none');
                } else {
                    $walkingTourContent->setButtonText($row['button_text']);
                }

                return $walkingTourContent;
        }}
        catch(PDOException $e){echo $e;}
    }

    public function getAllWalkingTourContent(){
        $query = "SELECT section_name FROM walkingTour_content";

        try{
            $statement = $this->connection->prepare($query);
            $statement->execute();

            while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $contentSection = $this->getContentByElement($row['section_name']);
                $allContent[] = $contentSection;
            }
            return $allContent;

        } catch(PDOException $e){echo $e;}
    }

    public function UpdateContent(string $oldSectionName, string $sectionNameInput, string $titleInput, string $textInput, string $buttonTextInput){

        $content = $this->getContentByElement($oldSectionName);

        $query = "UPDATE walkingTour_content SET section_name = :sectionName, title = :title, text = :text, button_text = :buttonText WHERE Id = :id";

        try{
            $statement = $this->connection->prepare($query);

            $sectionName = htmlspecialchars($sectionNameInput);
            $title = htmlspecialchars($titleInput);
            $text = htmlspecialchars($textInput);
            $buttonText = htmlspecialchars($buttonTextInput);
            $id = $content->getId();

            $statement->bindParam(':sectionName', $sectionName);
            $statement->bindParam(':title', $title);
            $statement->bindParam(':text', $text);
            $statement->bindParam(':buttonText', $buttonText);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);

            $statement->execute();

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function createContent(string $sectionNameInput, string $titleInput, string $textInput, string $buttonTextInput){
        $query = "INSERT INTO walkingTour_content (section_name, title, text, button_text, isCreated) 
                    VALUES (?,?,?,?,?)";

        try {
            $statement = $this->connection->prepare($query);
            $statement->execute(array(
                htmlspecialchars($sectionNameInput),
                htmlspecialchars($titleInput),
                htmlspecialchars($textInput),
                htmlspecialchars($buttonTextInput),
                1,
            ));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>