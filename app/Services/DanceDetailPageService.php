<?php
require __DIR__ . '/../Repositories/DanceDetailPageRepository.php';

class DanceDetailPageService
{
    private $danceDetailPageRepository; 

    //ctor
    public function __construct() {
        $this->danceDetailPageRepository = new DanceDetalPageRepository(); 
    }
    public function getDanceDetailPageContentById($detail_id)
    {
        return 1;
    }

    public function getDanceEventsByArtistIdFromRepository($artist_id){
        $danceEvents = $this->danceDetailPageRepository->getDanceEventsByArtistId($artist_id);
        return $danceEvents;
    }

}