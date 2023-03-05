<?php
require_once __DIR__ . '/repository.php';
require __DIR__ . '/../Models/ArtistModel.php';

class DanceRepository extends Repository{
    public function getAllArtists(){
        try{
            $statement = $this -> connection -> prepare("SELECT artist_id, artist_name, artist_MusicType, artist_HasDetailPage, artist_UrlInHomepage FROM artist");
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