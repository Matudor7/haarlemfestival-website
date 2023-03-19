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

    public function getDanceEventsByArtistId($artist_id){
        $danceEvents = $this->danceDetailPageRepository->getDanceEventsByArtistIdFromDatabase($artist_id);
        return $danceEvents;
    }

    public function getAllCareerHighlights($artist_id){
        $careerHighlights = $this->danceDetailPageRepository->getAllCareerHighlightsFromDatabase($artist_id);
        return $careerHighlights;
    }

}