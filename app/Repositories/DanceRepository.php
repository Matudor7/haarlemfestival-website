<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/ArtistModel.php';

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
            $artists = $statement->fetchAll();

            return $artists;
        }catch(PDOException $e){
            echo $e;
        }
    }

    /*public function getMusicTypesByArtist($artistId){
        try{
            $statement = $this -> connection -> prepare("SELECT `dance_artistMusicType_artistId`, `dance_artistMusicType_musicTypeId` FROM `dance_artistMusicType` WHERE `dance_artistMusicType_artistId` = :artistId");
            $statement->bindValue(':artistId', $artistId, PDO::PARAM_INT);
            $statement->execute();
    
            $statement->setFetchMode(PDO::FETCH_CLASS, 'ArtistMusicType');
            $artistMusicTypes = $statement->fetchAll();
    
            return $artistMusicTypes;
        }catch(PDOException $e){
            echo $e;
        }
    }   */ 
}
?>