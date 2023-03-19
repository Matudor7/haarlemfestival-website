<?php
require_once __DIR__ . "/repository.php";
require_once __DIR__ . "/../Models/ArtistModel.php";
require_once __DIR__ . "/../Models/MusicType.php";
require_once __DIR__ . "/../Models/DanceLocation.php";
require_once __DIR__ . "/../Models/DanceFlashback.php";
require_once __DIR__ . "/../Models/DanceEvent.php";
require_once __DIR__ . "/../Models/DanceCareerHighlight.php";

class DanceDetalPageRepository extends Repository
{
    //ARTIST
    public function getDanceEventsByArtistIdFromDatabase($artist_id)
    {
        $sql = "SELECT de.dance_event_id, de.dance_event_date, de.dance_event_time, dl.dance_location_name, GROUP_CONCAT(da.dance_artist_name 
        ORDER BY da.dance_artist_name ASC SEPARATOR ', ') AS performing_artists, ds.dance_sessionType_name, de.dance_event_duration, de.dance_event_availableTickets, de.dance_event_price, de.dance_event_extraNote 
        FROM dance_event de 
        JOIN dance_location dl ON dl.dance_location_id = de.dance_event_locationId 
        JOIN dance_sessionType ds ON ds.dance_sessionType_id = de.dance_event_sessionTypeId 
        JOIN dance_performingArtist dp ON dp.dance_performingArtist_eventId = de.dance_event_id 
        JOIN dance_artist da ON da.dance_artist_id = dp.dance_performingArtist_artistId 
        WHERE da.dance_artist_id = :artist_id
        GROUP BY de.dance_event_id, de.dance_event_date, de.dance_event_time, dl.dance_location_name, ds.dance_sessionType_name, de.dance_event_duration, de.dance_event_availableTickets, de.dance_event_price, de.dance_event_extraNote 
        ORDER BY de.dance_event_date ASC, de.dance_event_time ASC, dl.dance_location_name ASC;";

        try {
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(":artist_id", $artist_id, PDO::PARAM_INT);
            $statement->execute();
    
            $danceEvents = [];
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $danceEvent = new DanceEvent();
                $danceEvent->setDanceEventId($row['dance_event_id']);
                $danceEvent->setDanceLocationName($row['dance_location_name']);
                $danceEvent->setPerformingArtists($row['performing_artists']);
                $danceEvent->setDanceSessionTypeName($row['dance_sessionType_name']);
                $danceEvent->setDanceEventDuration($row['dance_event_duration']);
                $danceEvent->setDanceEventAvailableTickets($row['dance_event_availableTickets']);
                $danceEvent->setDanceEventPrice($row['dance_event_price']);
                $danceEvent->setDanceEventExtraNote($row['dance_event_extraNote']);
    
                // Convert date and time strings to DateTime object
                $date = new DateTime($row['dance_event_date']);
                $time = new DateTime($row['dance_event_time']);
                $dateTime = new DateTime();
                $dateTime->setDate($date->format('Y'), $date->format('m'), $date->format('d')); //date
                $dateTime->setTime($time->format('H'), $time->format('i'), $time->format('s')); //time
    
                $danceEvent->setDanceEventDateTime($dateTime);
                $danceEvents[] = $danceEvent;
            }
    
                return $danceEvents;
        } catch (PDOException $e) {
            error_log('Error retrieving dance events: ' . $e->getMessage());
            return [];
        }
    }

    //CAREER HIGHLIGHT
    public function getAllCareerHighlightsFromDatabase($artist_id){
        $sql = "SELECT `dance_careerHighlights_id`, `dance_careerHighlights_artistId`, `dance_careerHighlights_description`, `dance_careerHighlights_imageUrl`, `dance_careerHighlights_alignment` FROM `dance_careerHighlights` WHERE `dance_careerHighlights_artistId` = :artist_id";
        
        try {
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(":artist_id", $artist_id, PDO::PARAM_INT);
            $statement->execute();
    
            $careerHighlights = $statement->fetchAll(PDO::FETCH_CLASS, 'CareerHighlight');
            return $careerHighlights;
        } catch (PDOException $e) {
            error_log('Error retrieving career highlights: ' . $e->getMessage());
            return [];
        }
    }
}
?>