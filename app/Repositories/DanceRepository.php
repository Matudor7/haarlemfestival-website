<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/ArtistModel.php';
require __DIR__ . '/../Models/MusicType.php';
require __DIR__ . '/../Models/DanceLocation.php';

class DanceRepository extends Repository{
    public function getAllArtists(){
        try{
            $statement = $this -> connection -> prepare("SELECT `dance_artist_id`, `dance_artist_name`, `dance_artist_hasDetailPage`, `dance_artist_imageUrl`, `dance_artist_detailPageUrl` FROM `dance_artist` ORDER BY `dance_artist_hasDetailPage` DESC;");
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'ArtistModel');
            $artists = $statement->fetchAll();

            return $artists;
        }catch(PDOException $e){
            echo $e;
        }
    }

    public function getAllMusicTypes(){
        try{
            $statement = $this -> connection -> prepare("SELECT `dance_musicType_id`, `dance_musicType_name` FROM `dance_musicType`");
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'MusicType');
            $musicTypes = $statement->fetchAll();

            return $musicTypes;
        }catch(PDOException $e){
            echo $e;
        }
    }
    public function getMusicTypeById($id){
        try{
            $statement = $this -> connection -> prepare("SELECT `dance_musicType_id`, `dance_musicType_name` FROM `dance_musicType` WHERE `dance_musicType_id` = ?");
            $statement->execute([$id]);

            $statement->setFetchMode(PDO::FETCH_CLASS, 'MusicType');

            $musicType = $statement->fetchAll();

            return $musicType;
        }catch(PDOException $e){
            echo $e;
        }
    }

    public function getMusicTypesByArtist($artistId){
        try{
            $statement = $this->connection->prepare("SELECT `dance_artistMusicType_musicTypeId` FROM `dance_artistMusicType` WHERE `dance_artistMusicType_artistId` = ?");
            $statement->execute([$artistId]);
    
            $musicTypes = array();
    
            while ($row = $statement->fetch()) {
                $musicTypeId = $row['dance_artistMusicType_musicTypeId'];
                $musicType = $this->getMusicTypeById($musicTypeId);
                $musicTypes[] = $musicType;
            }
    
            return $musicTypes;
        } catch(PDOException $e){
            echo $e;
        }
    }

    public function getAllDanceLocations(){
        try{
            $statement = $this -> connection -> prepare("SELECT `dance_location_id`, `dance_location_name`, `dance_location_street`, `dance_location_number`, `dance_location_postcode`, `dance_location_city`, `dance_location_urlToTheirSite`, `dance_location_imageUrl` FROM `dance_location`");
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_CLASS, 'DanceLocation');
            $danceLocations = $statement->fetchAll();

            return $danceLocations;
        }catch(PDOException $e){
            echo $e;
        }
    }

}
?>