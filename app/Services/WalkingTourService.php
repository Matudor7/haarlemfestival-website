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

    public function getWalkingTourByLanguage(int $lanuageId) {

        $walkingTour = $this->walkingTourRepository->getWalkingTourByLanguage($lanuageId);

        return $walkingTour;
    }

    public function getTourPrices(){
        $prices = $this->walkingTourRepository->getTourPrices();

        return $prices;
    }

    public function getTourLocations(){
        $locations = $this->walkingTourRepository->getTourLocations();

        return $locations;
    }
}
?>