<?php
require __DIR__ . '/../Repositories/DanceRepository.php';

class DanceService
{   
    private $danceRepository; 

    //ctor
    public function __construct() {
        $this->danceRepository = new DanceRepository(); 
    }

    //ARTISTS 
    public function getAllArtists()
    {
        $artists = $this->danceRepository->getAllArtists();
        return $artists;
    }
    public function getArtistById($artist_id)
    {
        return $this->danceRepository->getArtistById($artist_id);    
    }

    //MUSIC TYPES
    public function getAllMusicTypes()
    {
        $musicTypes = $this->danceRepository->getAllMusicTypes();
        return $musicTypes;
    }
    public function insertMusicType($newMusicType){
        $this->danceRepository->insertNewMusicType($newMusicType);
    }

    // DANCE LOCATIONS
    public function getAllDanceLocations()
    {
        $danceLocations = $this->danceRepository->getAllDanceLocations();
        return $danceLocations;
    }
    public function insertDanceLocation($newDanceLocation){
        $this->danceRepository->insertNewDanceLocation($newDanceLocation);
    }
    public function getDanceLocationById($location_id){
        return $this->danceRepository->getDanceLocationByIdFromDatabase($location_id);   
    }
    public function deleteDanceLocation($danceLocation){
        $this->danceRepository->deleteDanceLocationFromDatabase($danceLocation);
    }

    // DANCE FLASHBACKS
    public function getAllDanceFlashbacks()
    {
        $danceFlashbacks = $this->danceRepository->getAllDanceFlashbacks();
        return $danceFlashbacks;
    }

    // DANCE EVENTS
    public function getAllDanceEvents()
    {
        $danceEvents = $this->danceRepository->getAllDanceEvents();
        return $danceEvents;
    }
}
?>