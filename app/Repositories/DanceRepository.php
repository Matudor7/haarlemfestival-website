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
}
?>