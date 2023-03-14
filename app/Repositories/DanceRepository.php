<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/ArtistModel.php';
require __DIR__ . '/../Models/MusicType.php';
require __DIR__ . '/../Models/DanceLocation.php';
require __DIR__ . '/../Models/DanceFlashback.php';
require __DIR__ . '/../Models/DanceEvent.php';

class DanceRepository extends Repository{

    // ARTISTS
    public function getAllArtists() {
        $sql = "SELECT `dance_artist_id`, `dance_artist_name`, `dance_artist_hasDetailPage`, `dance_artist_imageUrl`, `dance_artist_detailPageUrl` FROM `dance_artist` ORDER BY `dance_artist_hasDetailPage` DESC";
    
        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute();
    
            $artists = $statement->fetchAll(PDO::FETCH_CLASS, 'ArtistModel');
            return $artists;
        } catch (PDOException $e) {
            error_log('Error retrieving all artists: ' . $e->getMessage());
            return [];
        }
    }
    

    // MUSIC TYPES
    public function getAllMusicTypes() {
        $sql = "SELECT `dance_musicType_id`, `dance_musicType_name` FROM `dance_musicType`";
    
        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute();
    
            $musicTypes = $statement->fetchAll(PDO::FETCH_CLASS, 'MusicType');
            return $musicTypes;
        } catch (PDOException $e) {
            error_log('Error retrieving all music types: ' . $e->getMessage());
            return [];
        }
    }
    
    public function getMusicTypeById($id) {
        $sql = "SELECT `dance_musicType_id`, `dance_musicType_name` FROM `dance_musicType` WHERE `dance_musicType_id` = ?";
    
        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute([$id]);
    
            $musicType = $statement->fetchObject('MusicType');
            return $musicType;
        } catch (PDOException $e) {
            error_log('Error retrieving music type with id ' . $id . ': ' . $e->getMessage());
            return null;
        }
    }

    public function getMusicTypesByArtist($artistId) {
        $sql = "SELECT `dance_artistMusicType_musicTypeId` FROM `dance_artistMusicType` WHERE `dance_artistMusicType_artistId` = ?";
    
        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute([$artistId]);
    
            $musicTypes = array();
    
            while ($row = $statement->fetch()) {
                $musicTypeId = $row['dance_artistMusicType_musicTypeId'];
                $musicType = $this->getMusicTypeById($musicTypeId);
                $musicTypes[] = $musicType;
            }
    
            return $musicTypes;
        } catch (PDOException $e) {
            error_log('Error retrieving music types for artist with id ' . $artistId . ': ' . $e->getMessage());
            return array();
        }
    }    


    //DANCE LOCATIONS
    public function getAllDanceLocations(){
        $sql = "SELECT `dance_location_id`, `dance_location_name`, `dance_location_street`, `dance_location_number`, `dance_location_postcode`, `dance_location_city`, `dance_location_urlToTheirSite`, `dance_location_imageUrl` FROM `dance_location`";
        
        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute();
    
            $danceLocations = $statement->fetchAll(PDO::FETCH_CLASS, 'DanceLocation');
            return $danceLocations;
        } catch (PDOException $e) {
            error_log('Error retrieving dance locations: ' . $e->getMessage());
            return [];
        }
    } 


    // DANCE FLASHBACKS
    public function getAllDanceFlashbacks(){
        $sql = "SELECT `dance_flashback_id`, `dance_flashback_url`, `dance_flashback_credit`, `dance_flashback_extranote` FROM `dance_flashbacks`";
        
        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute();
    
            $danceFlashbacks = $statement->fetchAll(PDO::FETCH_CLASS, 'DanceFlashback');
            return $danceFlashbacks;
        } catch (PDOException $e) {
            error_log('Error retrieving dance event flashbacks: ' . $e->getMessage());
            return [];
        }
    }

    //DANCE EVENTS
    public function getAllDanceEvents(){
        $sql = "SELECT de.dance_event_id, de.dance_event_date, de.dance_event_time, dl.dance_location_name, GROUP_CONCAT(da.dance_artist_name 
        ORDER BY da.dance_artist_name ASC SEPARATOR ', ') AS performing_artists, ds.dance_sessionType_name, de.dance_event_duration, de.dance_event_availableTickets, de.dance_event_price, de.dance_event_extraNote 
        FROM dance_event de 
        JOIN dance_location dl ON dl.dance_location_id = de.dance_event_locationId 
        JOIN dance_sessionType ds ON ds.dance_sessionType_id = de.dance_event_sessionTypeId 
        JOIN dance_performingArtist dp ON dp.dance_performingArtist_eventId = de.dance_event_id 
        JOIN dance_artist da ON da.dance_artist_id = dp.dance_performingArtist_artistId 
        GROUP BY de.dance_event_id, de.dance_event_date, de.dance_event_time, dl.dance_location_name, ds.dance_sessionType_name, de.dance_event_duration, de.dance_event_availableTickets, de.dance_event_price, de.dance_event_extraNote 
        ORDER BY de.dance_event_date ASC, de.dance_event_time ASC, dl.dance_location_name ASC;";
        
        /*SELECT de.dance_event_id,  DATE(de.dance_event_date) AS dance_event_date, STR_TO_DATE(de.dance_event_time, '%H:%i') AS dance_event_time, dl.dance_location_name, GROUP_CONCAT(da.dance_artist_name 
ORDER BY da.dance_artist_name ASC SEPARATOR ', ') AS performing_artists, ds.dance_sessionType_name, de.dance_event_duration, de.dance_event_availableTickets, de.dance_event_price, de.dance_event_extraNote 
FROM dance_event de 
JOIN dance_location dl ON dl.dance_location_id = de.dance_event_locationId 
JOIN dance_sessionType ds ON ds.dance_sessionType_id = de.dance_event_sessionTypeId 
JOIN dance_performingArtist dp ON dp.dance_performingArtist_eventId = de.dance_event_id 
JOIN dance_artist da ON da.dance_artist_id = dp.dance_performingArtist_artistId 
GROUP BY de.dance_event_id, de.dance_event_date, de.dance_event_time, dl.dance_location_name, ds.dance_sessionType_name, de.dance_event_duration, de.dance_event_availableTickets, de.dance_event_price, de.dance_event_extraNote 
ORDER BY de.dance_event_date ASC, de.dance_event_time ASC, dl.dance_location_name ASC*/

        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute();
    
            $danceEvents = $statement->fetchAll(PDO::FETCH_CLASS, 'DanceEvent');
            return $danceEvents;
        } catch (PDOException $e) {
            error_log('Error retrieving dance events: ' . $e->getMessage());
            return [];
        }
    }
}
?>