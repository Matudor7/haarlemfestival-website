<?php
require __DIR__ . '/../Repositories/DanceRepository.php';

class DanceService
{   
    private $danceRepository; 

    //ctor
    public function __construct() {
        $this->danceRepository = new DanceRepository(); 
    }

    public function getAllArtists()
    {
        $artists = $this->danceRepository->getAllArtists();
        return $artists;
    }

    /*public function getArtistMusicTypes($artistId)
    {
        $artists = $this->danceRepository->getMusicTypesByArtist($artistId);
        return $artists;
    }*/
}
?>