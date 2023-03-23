<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/ArtistModel.php';
require __DIR__ . '/../Models/MusicType.php';
require __DIR__ . '/../Models/DanceLocation.php';
require __DIR__ . '/../Models/DanceFlashback.php';
require __DIR__ . '/../Models/DanceEvent.php';

class DanceRepository extends Repository{

    // ARTISTS
    public function getAllArtists() 
    {
        $sql = "SELECT da.dance_artist_id, da.dance_artist_name, GROUP_CONCAT(DISTINCT dmt.dance_musicType_name SEPARATOR ', ') AS dance_artistMusicTypes, da.dance_artist_hasDetailPage, da.dance_artist_imageUrl, da.dance_artist_detailPageUrl 
        FROM dance_artist da
        JOIN dance_artistMusicType damt ON damt.dance_artistMusicType_artistId = da.dance_artist_id
        JOIN dance_musicType dmt ON dmt.dance_musicType_id = damt.dance_artistMusicType_musicTypeId
        GROUP BY da.dance_artist_id, da.dance_artist_name, da.dance_artist_hasDetailPage, da.dance_artist_imageUrl, da.dance_artist_detailPageUrl 
        ORDER BY da.dance_artist_hasDetailPage DESC;";
    
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

    public function getArtistById($artist_id) 
    {
        $sql = "SELECT da.dance_artist_id, da.dance_artist_name, GROUP_CONCAT(DISTINCT dmt.dance_musicType_name SEPARATOR ', ') AS dance_artistMusicTypes, da.dance_artist_hasDetailPage, da.dance_artist_imageUrl, da.dance_artist_detailPageUrl, da.dance_artist_detailPageBanner, da.dance_artist_subHeader, da.dance_artist_longDescription, da.dance_artist_longDescriptionPicture, da.dance_artist_detailPageSchedulePicture 
                FROM dance_artist da 
                JOIN dance_artistMusicType damt ON damt.dance_artistMusicType_artistId = da.dance_artist_id 
                JOIN dance_musicType dmt ON dmt.dance_musicType_id = damt.dance_artistMusicType_musicTypeId 
                WHERE da.dance_artist_id = :artist_id 
                GROUP BY da.dance_artist_id, da.dance_artist_name, da.dance_artist_hasDetailPage, da.dance_artist_imageUrl, da.dance_artist_detailPageUrl";
        try {
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':artist_id', $artist_id, PDO::PARAM_INT);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'ArtistModel');
            $artist = $statement->fetch();
            return $artist;
        } catch (PDOException $e) {
            error_log('Error retrieving artist with id ' . $artist_id . ': ' . $e->getMessage());
            return null;
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
    
    /*public function getMusicTypeById($id) {
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
    }*/

    /*public function getMusicTypesByArtist($artistId) {
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
    }   */ 


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
    
        try {
            $statement = $this->connection->prepare($sql);
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
}
?>