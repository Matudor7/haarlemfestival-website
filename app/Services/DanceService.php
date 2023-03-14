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

    //MUSIC TYPES
    public function getArtistMusicTypes($artistId)
    {
        $musicTypes = $this->danceRepository->getMusicTypesByArtist($artistId);
        return $musicTypes;
    }

    // DANCE LOCATIONS
    public function getAllDanceLocations()
    {
        $danceLocations = $this->danceRepository->getAllDanceLocations();
        return $danceLocations;
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