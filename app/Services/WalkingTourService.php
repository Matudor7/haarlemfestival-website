<?php 
require __DIR__ . '/../Repositories/walkingTourRepository.php';

class WalkingTourService {

    private $walkingTourRepository;

    public function __construct() {
        $this->walkingTourRepository = new WalkingTourRepository();
    }

    public function getAllWalkingTours() {

        $walkingTours = $this->walkingTourRepository->getAllWalkingTours();

        return $walkingTours;
    }

    public function getWalkingTourById(int $id) {

        $walkingTour = $this->walkingTourRepository->getWalkingTourById($id);

        return $walkingTour;
    }

    public function getWalkingTourByLanguage(int $languageId) {

        $walkingTour = $this->walkingTourRepository->getWalkingTourByLanguage($languageId);

        return $walkingTour;
    }

    public function getTourPrices(){
        $prices = $this->walkingTourRepository->getTourPrices();

        return $prices;
    }
    public function getTourPriceById(int $id){
        return $this->walkingTourRepository->getTourPriceById($id);
    }
    public function getTourLocations(){
        $locations = $this->walkingTourRepository->getTourLocations();

        return $locations;
    }
    public function getTourLocationById(int $id){
        return $this->walkingTourRepository->getTourLocationById($id);
    }
    public function getTourTimetable(){
        $timetables = $this->walkingTourRepository->getTourTimetable();
        return $timetables;
    }
    public function getTourLanguages(){
        return $this->walkingTourRepository->getTourLanguages();
    }
    public function getTourLanguageById(int $id){
        return $this->walkingTourRepository->getTourLanguageById($id);
    }
    public function getContentByElement(string $elementId){
        return $this->walkingTourRepository->getContentByElement($elementId);
    }
}
?>